<?php declare(strict_types=1);

require_once __DIR__ . '/src/Applicant.php';
require_once __DIR__ . '/src/Company.php';

require_once __DIR__ . '/generator/static.php';
//require_once __DIR__ . '/generator/random.php';

/** @param Company[] $companies */
function makeOffers(array $companies)
{
	foreach ($companies as $company) {
		$company->offerEmployment();
	}

    foreach ($companies as $company) {
        if (!$company->isDoneOfferingJob()) {
            return true;
        }
    }

	return false;
}

/**
 * @param Applicant[] $applicants
 * @param Company[] $companies
 */
function debug(array $applicants, array $companies) {
	foreach ($applicants as $applicant) {
		$preferences = $applicant->preferences();
		$firstPreference = array_shift($preferences);

		printf("%s: !%s!, %s | %s\n", $applicant->name(), $firstPreference->name(), implode(',', array_map(function (Company $company) {
			return $company->name();
		}, $preferences)), $applicant->acceptedOffer() ? $applicant->acceptedOffer()->name() : 'none');
	}

	printf("-----\n");

	foreach ($companies as $company) {
		printf("%s: %s | %s\n", $company->name(), implode(',', array_map(function (Applicant $applicant) {
			return $applicant->name();
		}, $company->preferences())), implode(',', array_map(function (Applicant $applicant) {
			return $applicant->name();
		}, $company->acceptedOffers())));
	}

	printf("\n");
};

debug($applicants, $companies);

$i = 0;
do {
	$wannaContinue = makeOffers($companies);
	debug($applicants, $companies);
} while($wannaContinue === true); // && $i++ < 3
