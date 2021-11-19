<?php

namespace Fut7\Infrastructure\Persistence\Season;

use Fut7\Domain\Contract\Repository\SeasonRepositoryInterface;
use Fut7\Domain\Entity\Season\Season;
use Fut7\Domain\Exception\Season\SeasonCreateException;
use Fut7\Domain\Exception\Season\SeasonDeleteException;
use Fut7\Domain\Exception\Season\SeasonNotFoundException;
use Fut7\Domain\Exception\Season\SeasonUpdateException;
use Fut7\Infrastructure\Persistence\Shared\Csv\Exception\CsvItemNotFoundException;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;
use League\Csv\CannotInsertRecord;


class CsvSeasonRepository implements SeasonRepositoryInterface
{
    private CsvRepository $repository;

    public function __construct(CsvRepository $repository)
    {
        $this->repository = $repository;
    }

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
            $this->repository->showData();
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

}