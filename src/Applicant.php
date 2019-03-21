<?php declare(strict_types=1);

class Applicant
{

	/** @var string */
	private $name;

	/** @var Company[] */
	private $preferences = [];

	/** @var Company|null */
	private $currentlyTheBestOffer;

	public function __construct(string $name)
	{
		$this->name = $name;
	}

	public function name(): string
	{
		return $this->name;
	}

	/** @param Company[] $preferences */
	public function setPreferences(array $preferences = []): void
	{
		$this->preferences = $preferences;
	}

	/** @return Company[] */
	public function preferences(): array
	{
		return $this->preferences;
	}

    public function acceptedOffer(): ?Company
    {
        return $this->currentlyTheBestOffer;
    }

    public function receiveOffer(Company $company): bool
	{
		$currentOfferWeight = array_search($company, $this->preferences, true);

		// applicant doesn't want to work in given company
		if ($currentOfferWeight === false) {
			return false;
		}

		// the first offer, accept it right away
		if ($this->currentlyTheBestOffer === null) {
			$this->currentlyTheBestOffer = $company;
			return true;
		}

		$currentlyBestWeight = array_search($this->currentlyTheBestOffer, $this->preferences, true);

		// preference is given by position in array - lower index is more preffered
		if ($currentOfferWeight < $currentlyBestWeight) {
			$this->currentlyTheBestOffer->receiveRejectedOffer($this);
			$this->currentlyTheBestOffer = $company;
			return true;
		}

		return false;
	}

}
