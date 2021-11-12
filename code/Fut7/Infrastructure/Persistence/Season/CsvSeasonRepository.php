<?php

namespace Fut7\Infrastructure\Persistence\Season;

use Fut7\Domain\Contract\Repository\SeasonRepositoryInterface;
use Fut7\Domain\Entity\Season\Season;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;


class CsvSeasonRepository implements SeasonRepositoryInterface
{
    private CsvRepository $repository;

    public function __construct(CsvRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(Season $season)
    {
        $header = ['id', 'name', 'createdAt', 'updatedAt'];
        $records = [
            [
                $season->id(),
                $season->name(),
                $season->createdAt()->format('Y-m-d H:i:s'),
                $season->updatedAt()->format('Y-m-d H:i:s'),
            ],
        ];

        $data = ['header' => $header, 'records' => $records];
        $this->repository->create($data);
    }

    /**
     * @throws \Fut7\Domain\Exception\Season\SeasonNotFoundException
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function search(array $criteria)
    {
        // TODO: Implement search() method.
    }

    public function update(Season $season)
    {
        // TODO: Implement update() method.
    }

    public function delete(Season $season)
    {
        $this->repository->delete($season->id());
    }

}