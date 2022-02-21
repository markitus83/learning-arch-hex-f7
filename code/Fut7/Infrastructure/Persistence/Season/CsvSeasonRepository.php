<?php

namespace Fut7\Infrastructure\Persistence\Season;

use Fut7\Domain\Contract\Repository\SeasonRepositoryInterface;
use Fut7\Domain\Entity\Season\Season;
use Fut7\Domain\Exception\Season\SeasonCreateException;
use Fut7\Domain\Exception\Season\SeasonDeleteException;
use Fut7\Domain\Exception\Season\SeasonNotFoundException;
use Fut7\Domain\Exception\Season\SeasonUpdateException;
use Fut7\Infrastructure\Persistence\Shared\Csv\Exception\CsvItemNotFoundException;
use Fut7\Infrastructure\Persistence\Shared\Csv\Fut7CsvRepository;
use League\Csv\CannotInsertRecord;


class CsvSeasonRepository extends Fut7CsvRepository implements SeasonRepositoryInterface
{
    public const REPOSITORY_FILE = 'Season.csv';

    /**
     * @param Season $season
     * @throws SeasonCreateException
     */
    public function create(Season $season)
    {
        $header = ['uuid', 'name', 'createdAt', 'updatedAt'];
        try {
            $this->repository->createHeaders($header);
        } catch (CannotInsertRecord $cannotInsertRecord) {
            throw new SeasonCreateException($season->id());
        }

        $record = [
            [
                $season->uuid(),
                $season->name(),
                $season->createdAt()->format('Y-m-d H:i:s'),
                $season->updatedAt()->format('Y-m-d H:i:s'),
            ],
        ];

        try {
            $this->repository->create($record);
        } catch (CannotInsertRecord $cannotInsertRecord) {
            throw new SeasonCreateException($season->id());
        }
    }

    /**
     * @param $id
     * @return Season
     * @throws SeasonNotFoundException
     */
    public function find($id): Season
    {
        try {
            return Season::createFromRepository($this->repository->find($id));
        } catch (CsvItemNotFoundException $csvItemNotFoundException) {
            throw new SeasonNotFoundException($id);
        } catch (\Exception $e) {
            echo $e->getMessage();
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
     * @param Season $season
     * @throws SeasonUpdateException
     */
    public function update(Season $season)
    {
        $record = [
            [
                $season->uuid(),
                $season->name(),
                $season->createdAt()->format('Y-m-d H:i:s'),
                $season->updatedAt()->format('Y-m-d H:i:s'),
            ],
        ];
        try{
            $this->repository->update($season->uuid(), $record);
        } catch (CannotInsertRecord $cannotInsertRecord) {
            throw new SeasonUpdateException($season->uuid());
        }
    }

    /**
     * @param Season $season
     * @throws SeasonDeleteException
     */
    public function delete(Season $season)
    {
        try{
            $this->repository->delete($season->uuid());
        } catch (CannotInsertRecord $cannotInsertRecord) {
            throw new SeasonDeleteException($season->uuid());
        }
    }

    public function showData(): void
    {
        $this->repository->showData();
    }

}