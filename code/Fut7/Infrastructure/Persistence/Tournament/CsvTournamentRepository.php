<?php

namespace Fut7\Infrastructure\Persistence\Tournament;

use Fut7\Domain\Contract\Repository\TournamentRepositoryInterface;
use Fut7\Domain\Entity\Season\Season;
use Fut7\Domain\Entity\Tournament\Tournament;
use Fut7\Domain\Exception\Season\SeasonNotFoundException;
use Fut7\Domain\Exception\Tournament\TournamentCreateException;
use Fut7\Domain\Exception\Tournament\TournamentDeleteException;
use Fut7\Domain\Exception\Tournament\TournamentNotFoundException;
use Fut7\Domain\Exception\Tournament\TournamentUpdateException;
use Fut7\Infrastructure\Persistence\Season\CsvSeasonRepository;
use Fut7\Infrastructure\Persistence\Shared\Csv\Exception\CsvItemNotFoundException;
use Fut7\Infrastructure\Persistence\Shared\Csv\Fut7CsvRepository;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;
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
        $header = ['id', 'name', 'seasonId', 'createdAt', 'updatedAt'];
        try {
            $this->repository->createHeaders($header);
        } catch (CannotInsertRecord $cannotInsertRecord) {
            throw new TournamentCreateException($tournament->id());
        }

        $record = [
            [
                $tournament->id(),
                $tournament->name(),
                $tournament->season()->id(),
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

    /**
     * @param $id
     * @return mixed
     * @throws TournamentNotFoundException
     */
    public function find($id)
    {
        try {
            $tournament = $this->repository->find($id);
            $seasonRepository = new CsvSeasonRepository(new CsvRepository(CsvSeasonRepository::repositoryFile()));
            $season = $seasonRepository->find($tournament[2]);
            $tournament[2] = $season;

            return Tournament::createFromRepository($tournament);
        } catch (CsvItemNotFoundException $csvItemNotFoundException) {
            throw new TournamentNotFoundException($id);
        } catch (SeasonNotFoundException $seasonNotFoundException) {
            throw new SeasonNotFoundException($tournament[2]);
        }
    }

    /**
     * @param array $criteria
     * @return array
     */
    public function search(array $criteria): array
    {
        return $this->repository->search($criteria);
    }

    /**
     * @param Tournament $tournament
     * @throws TournamentUpdateException
     */
    public function update(Tournament $tournament)
    {
        $record = [
            [
                $tournament->id(),
                $tournament->name(),
                $tournament->season()->id(),
                $tournament->createdAt()->format('Y-m-d H:i:s'),
                $tournament->updatedAt()->format('Y-m-d H:i:s'),
            ],
        ];
        try{
            $this->repository->update($tournament->id(), $record);
        } catch (CannotInsertRecord $cannotInsertRecord) {
            throw new TournamentUpdateException($tournament->id());
        }
    }

    /**
     * @param Tournament $tournament
     * @throws TournamentDeleteException
     */
    public function delete(Tournament $tournament)
    {
        try{
            $this->repository->delete($tournament->id());
        } catch (CannotInsertRecord $cannotInsertRecord) {
            throw new TournamentDeleteException($tournament->id());
        }
    }

    public function showData(): void
    {
        $this->repository->showData();
    }

}