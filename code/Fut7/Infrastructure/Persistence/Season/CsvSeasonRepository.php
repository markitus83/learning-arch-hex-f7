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
        $header = ['id', 'name', 'createdAt', 'updatedAt'];
        try {
            $this->repository->createHeaders($header);
        } catch (CannotInsertRecord $cannotInsertRecord) {
            throw new SeasonCreateException($season->id());
        }

        $record = [
            [
                $season->id(),
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
     * @return mixed
     * @throws SeasonNotFoundException
     */
    public function find($id)
    {
        try {
            return $this->repository->find($id);
        } catch (CsvItemNotFoundException $csvItemNotFoundException) {
            throw new SeasonNotFoundException($id);
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
                $season->id(),
                $season->name(),
                $season->createdAt()->format('Y-m-d H:i:s'),
                $season->updatedAt()->format('Y-m-d H:i:s'),
            ],
        ];
        try{
            $this->repository->update($season->id(), $record);
        } catch (CannotInsertRecord $cannotInsertRecord) {
            throw new SeasonUpdateException($season->id());
        }
    }

    /**
     * @param Season $season
     * @throws SeasonDeleteException
     */
    public function delete(Season $season)
    {
        try{
            $this->repository->delete($season->id());
        } catch (CannotInsertRecord $cannotInsertRecord) {
            throw new SeasonDeleteException($season->id());
        }
    }

    public function showData(): void
    {
        $this->repository->showData();
    }

}