<?php namespace App\Repositories;


use App\Exceptions\EntityNotFoundException;
use App\Models\League;
use App\Models\Match;
use Illuminate\Database\Eloquent\Collection;

interface MatchRepositoryInterface
{

    /**
     * @return Collection|Match[]
     */
    public function getAll();

    /**
     * @param integer $id
     *
     * @return Match
     */
    public function find($id);

    /**
     * @param integer $id
     *
     * @return Match
     * @throws EntityNotFoundException
     */
    public function findOrFail($id);

    /**
     * @param string $odds
     *
     * @return Collection|Match[]
     */
    public function findByOdds($odds);

    /**
     * @param string $odds
     *
     * @return Collection|Match[]
     * @throws EntityNotFoundException
     */
    public function findByOddsOrFail($odds);

    /**
     * @param string $parameter
     *
     * @return Collection|Match[]
     */
    public function findByParameter($parameter);

    /**
     * @param string $parameter
     *
     * @return Collection|Match[]
     * @throws EntityNotFoundException
     */
    public function findByParameterOrFail($parameter);

    /**
     * @param string $type
     *
     * @return Collection|Match[]
     */
    public function findByType($type);

    /**
     * @param string $type
     *
     * @return Collection|Match[]
     * @throws EntityNotFoundException
     */
    public function findByTypeOrFail($type);

    /**
     * @param string $status
     *
     * @return Collection|Match[]
     */
    public function findByStatus($status);

    /**
     * @param string $status
     *
     * @return Collection|Match[]
     * @throws EntityNotFoundException
     */
    public function findByStatusOrFail($status);

    /**
     * @param League $league
     *
     * @return Collection|Match[]
     */
    public function findByLeague(League $league);

    /**
     * @param League $league
     *
     * @return Collection|Match[]
     * @throws EntityNotFoundException
     */
    public function findByLeagueOrFail(League $league);

    /**
     * @param Match $match
     */
    public function save(Match $match);

    /**
     * @param Match $match
     */
    public function delete(Match $match);

    /**
     * @param string $odds
     * @param string $parameter
     * @param string   $type
     * @param string   $league_id
     *
     * @return Collection|Match[]
     */
    public function search($odds = '', $parameter = '', $type = null, $league_id = null);

}