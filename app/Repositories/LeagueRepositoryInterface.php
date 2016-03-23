<?php namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Models\League;
use Illuminate\Database\Eloquent\Collection;

interface LeagueRepositoryInterface
{
    /**
     * @return Collection|League[]
     */
    public function getAll();

    /**
     * @return Collection|League[]
     */
    public function getLast5Alpha();

    /**
     * @return Collection|League[]
     */
    public function getAllAlpha();

    /**
     * @param integer $id
     *
     * @return League|null
     */
    public function find($id);

    /**
     * @param integer $id
     *
     * @return League
     * @throws EntityNotFoundException
     */
    public function findOrFail($id);

    /**
     * @param string $name
     *
     * @return Collection|League[]
     */
    public function findByName($name);

    /**
     * @param League $league
     */
    public function save(League $league);

    /**
     * @param League $league
     */
    public function delete(League $league);
}