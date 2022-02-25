<?php namespace Fut7\Domain\Response\Season;

use Fut7\Domain\Contract\Response\DomainResponseInterface;

class SearchSeasonResponse implements DomainResponseInterface
{
    private array $seasons;

    public function __construct($seasons)
    {
        if ('array' !== gettype($seasons)) {
            throw new \TypeError("Response must be an array!! ".gettype($seasons));
        }
        $this->seasons = $seasons;
    }

    public function seasons()
    {
        return $this->seasons;
    }

    public function getResponse(): array
    {
        return [
            'message' => 'Seasons found after search:',
            'data' => $this->seasons()
        ];
    }
}