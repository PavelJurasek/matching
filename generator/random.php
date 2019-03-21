<?php declare(strict_types=1);

$companyCount = random_int(4, 10);
$maxApplicantCount = 0;

/** @var Applicant[] $applicants */
$applicants = [];

/** @var Company[] $companies */
$companies = [];

for ($i = 1; $i < $companyCount; $i++) {
	$companies[] = new Company(sprintf('C%0d', $i), $maxApplicantCount += random_int(5, 10));
}

$applicantCount = random_int($maxApplicantCount - 30, $maxApplicantCount);

for ($i = 1; $i < $applicantCount; $i++) {
	$applicants[] = new Applicant(sprintf('A%03d', $i));
}

printf("Company count: %d\n", count($companies));

printf("Applicant count: %d\n", count($applicants));

$applicantIndexes = range(0, $applicantCount - 2);

foreach ($companies as $company) {
	shuffle($applicantIndexes);
	$indexes = array_slice($applicantIndexes, 0, $company->maxCapacity());
	$preferences = [];

	foreach ($indexes as $index) {
		$preferences[] = $applicants[$index];
	}

	$company->setPreferences($preferences);
}

$companyIndexes = range(0, $companyCount - 2);

foreach ($applicants as $applicant) {
	shuffle($companyIndexes);
	$indexes = array_slice($companyIndexes, 0, random_int(3, $companyCount - 1));
	$preferences = [];

	foreach ($indexes as $index) {
		$preferences[] = $companies[$index];
	}

	$applicant->setPreferences($preferences);
}
