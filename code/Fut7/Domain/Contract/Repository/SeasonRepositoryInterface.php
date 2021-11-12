<?php namespace Fut7\Domain\Contract\Repository;

use Fut7\Domain\Entity\Season\Season;

interface SeasonRepositoryInterface
{
    public function create(Season $season);
    public function find($id);
    public function search(array $criteria);
    public function update(Season $season);
    public function delete(Season $season);
}