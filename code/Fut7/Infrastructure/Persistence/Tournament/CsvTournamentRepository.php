<?php

namespace Fut7\Infrastructure\Persistence\Tournament;

use Fut7\Domain\Contract\Repository\TournamentRepositoryInterface;
use Fut7\Domain\Entity\Tournament\Tournament;
use Fut7\Domain\Exception\Tournament\TournamentCreateException;
use Fut7\Infrastructure\Persistence\Shared\Csv\Fut7CsvRepository;
use League\Csv\CannotInsertRecord;

class CsvTournamentRepository extends Fut7CsvRepository implements TournamentRepositoryInterface
{
    public const REPOSITORY_FILE = 'Tournament.csv';

    /**
     * @param Tournament $tournament
     * @throws TournamentCreateException
     */
    public function create(Tournament $tournament)
    {
        $header = ['id', 'name', 'season', 'createdAt', 'updatedAt'];
        try {
            $this->repository->createHeaders($header);
        } catch (CannotInsertRecord $cannotInsertRecord) {
            throw new TournamentCreateException($tournament->id());
        }

        $record = [
            [
                $tournament->id(),
                $tournament->name(),
                $tournament->season(),
                $tournament->createdAt()->format('Y-m-d H:i:s'),
                $tournament->updatedAt()->format('Y-m-d H:i:s'),
            ],
        ];

        try {
            $this->repository->create($record);
        } catch (CannotInsertRecord $cannotInsertRecord) {
            throw new TournamentCreateException($tournament->id());
        }
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }

    public function search(array $criteria)
    {
        // TODO: Implement search() method.
    }

    public function update(Tournament $tournament)
    {
        // TODO: Implement update() method.
    }

    public function delete(Tournament $tournament)
    {
        // TODO: Implement delete() method.
    }

    public function showData()
    {
        // TODO: Implement showData() method.
    }
}