<?php declare(strict_types=1);

/** @var Applicant[] $applicants */
$applicants = [
    new Applicant('A'),
    new Applicant('B'),
    new Applicant('C'),
    new Applicant('D'),
    new Applicant('E'),
];

/** @var Company[] $companies */
$companies = [
    new Company('C1', 2),
    new Company('C2', 3),
    new Company('C3', 2),
];

$applicants[0]->setPreferences([$companies[0], $companies[1]]);
$applicants[1]->setPreferences([$companies[1], $companies[2]]);
$applicants[2]->setPreferences([$companies[0], $companies[2]]);
$applicants[3]->setPreferences([$companies[2], $companies[1]]);
$applicants[4]->setPreferences([$companies[1], $companies[2]]);

$companies[0]->setPreferences([$applicants[0], $applicants[1], $applicants[2]]);
$companies[1]->setPreferences([$applicants[2], $applicants[3], $applicants[4]]);
$companies[2]->setPreferences([$applicants[1], $applicants[3], $applicants[0]]);
