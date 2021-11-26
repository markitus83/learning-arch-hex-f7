<?php

namespace Fut7\Domain\Contract\Repository;

use Fut7\Domain\Entity\Tournament\Tournament;

interface TournamentRepositoryInterface
{
    public function create(Tournament $tournament);
    public function find($id);
    public function search(array $criteria);
    public function update(Tournament $tournament);
    public function delete(Tournament $tournament);
    public function showData();
}