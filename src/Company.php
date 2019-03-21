<?php declare(strict_types=1);

class Company
{

	/** @var string */
	private $name;

	/** @var int */
	private $confirmedOffers = 0;

	/** @var int */
	private $maxCapacity;

	/** @var Applicant[] $preferences */
	private $preferences;

	/** @var array<int, ?bool> */
	private $responses = [];

	public function __construct(string $name, int $maxCapacity)
	{
		$this->name = $name;
		$this->maxCapacity = $maxCapacity;
	}

	public function name(): string
	{
		return $this->name;
	}

    public function maxCapacity(): int
    {
        return $this->maxCapacity;
    }

	/** @param Applicant[] $preferences */
	public function setPreferences(array $preferences = []): void
	{
		$this->preferences = $preferences;
		$this->responses = array_fill(0, count($preferences), null);
	}

	/** @return Applicant[] */
	public function preferences(): array
	{
		return $this->preferences;
	}

    /** @return Applicant[] */
    public function acceptedOffers(): array
    {
        $result = [];

        foreach ($this->responses as $i => $response) {
            if ($response === true) {
                $result[] = $this->preferences[$i];
            }
        }

        return $result;
    }

    public function offerEmployment(): void
	{
		if ($this->confirmedOffers === $this->maxCapacity) {
			return;
		}

		$offeredPlaces = $this->confirmedOffers;
		foreach ($this->preferences as $i => $applicant) {
			if ($this->responses[$i] !== null) {
				continue;
			}

			if ($offeredPlaces === $this->maxCapacity) {
				break;
			}

			if ($this->responses[$i] === null) {
				$this->responses[$i] = $applicant->receiveOffer($this);

				$offeredPlaces++;
			}
		}

		$this->confirmedOffers = count(array_filter($this->responses, function(?bool $response): bool {
			return $response === true;
		}));
	}

    public function receiveRejectedOffer(Applicant $applicant): void
	{
		$key = array_search($applicant, $this->preferences, true);
		$this->responses[$key] = false;
		$this->confirmedOffers--;
	}

    public function isDoneOfferingJob(): bool
    {
        // count how many applicants were not reached out yet
        $notOffered = 0;
        foreach ($this->responses as $response) {
            if ($response === null) {
                $notOffered++;
            }
        }

        // done if all the capacity is filled or applicants were reached out
        return $this->confirmedOffers === $this->maxCapacity || $notOffered === 0;
	}

}
