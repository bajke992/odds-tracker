<?php namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Models\League;
use App\Models\Match;
use Illuminate\Database\Eloquent\Collection;
use InvalidArgumentException;

class EloquentMatchRepository implements MatchRepositoryInterface
{

    /**
     * @var Match
     */
    private $match;

    /**
     * EloquentMatchRepository constructor.
     *
     * @param Match $match
     *
     * @internal param LeagueRepositoryInterface $leagueRepo
     */
    public function __construct(Match $match)
    {
        $this->match = $match;
    }

    /**
     * @return Collection|Match[]
     */
    public function getAll()
    {
        return $this->match->all()->reverse();
    }

    /**
     * @param integer $id
     *
     * @return Match
     */
    public function find($id)
    {
        return $this->match->query()->find($id);
    }

    /**
     * @param integer $id
     *
     * @return Match
     * @throws EntityNotFoundException
     */
    public function findOrFail($id)
    {
        $match = $this->find($id);

        if ($match === null) {
            throw new EntityNotFoundException("Match not found.");
        }

        return $match;
    }

    /**
     * @param string $odds
     *
     * @return Collection|Match[]
     */
    public function findByOdds($odds)
    {
        return $this->match->query()->where('odds', 'LIKE', '%'.$odds.'%')->get();
    }

    /**
     * @param string $odds
     *
     * @return Collection|Match[]
     * @throws EntityNotFoundException
     */
    public function findByOddsOrFail($odds)
    {
        $matches = $this->findByOdds($odds);
        if ($matches === null) {
            throw new EntityNotFoundException("Match not found.");
        }

        return $matches;
    }

    /**
     * @param string $parameter
     *
     * @return Collection|Match[]
     */
    public function findByParameter($parameter)
    {
        return $this->match->query()->where('parameter', 'LIKE', '%'.$parameter.'%')->get();
    }

    /**
     * @param string $parameter
     *
     * @return Collection|Match[]
     * @throws EntityNotFoundException
     */
    public function findByParameterOrFail($parameter)
    {
        $matches = $this->findByParameter($parameter);
        if ($matches === null) {
            throw new EntityNotFoundException("Match not found.");
        }

        return $matches;
    }

    /**
     * @param string $type
     *
     * @return Collection|Match[]
     */
    public function findByType($type)
    {
        return $this->match->query()->where('type', 'LIKE', '%'.$type.'%')->get();
    }

    /**
     * @param string $type
     *
     * @return Collection|Match[]
     * @throws EntityNotFoundException
     */
    public function findByTypeOrFail($type)
    {
        $matches = $this->findByType($type);
        if ($matches === null) {
            throw new EntityNotFoundException("Match not found.");
        }

        return $matches;
    }

    /**
     * @param string $status
     *
     * @return Collection|Match[]
     */
    public function findByStatus($status)
    {
        return $this->match->query()->where('status', 'LIKE', '%'.$status.'%')->get();
    }

    /**
     * @param string $status
     *
     * @return Collection|Match[]
     * @throws EntityNotFoundException
     */
    public function findByStatusOrFail($status)
    {
        $matches = $this->findByStatus($status);
        if ($matches === null) {
            throw new EntityNotFoundException("Match not found.");
        }

        return $matches;
    }

    /**
     * @param League $league
     *
     * @return Collection|Match[]
     */
    public function findByLeague(League $league)
    {
        return $league->matches;
    }

    /**
     * @param League $league
     *
     * @return Collection|Match[]
     * @throws EntityNotFoundException
     */
    public function findByLeagueOrFail(League $league)
    {
        $matches = $this->findByLeague($league);
        if ($matches === null) {
            throw new EntityNotFoundException("Match not found.");
        }

        return $matches;
    }

    /**
     * @param Match $match
     */
    public function save(Match $match)
    {
        $match->save();
    }

    /**
     * @param Match $match
     */
    public function delete(Match $match)
    {
        $match->delete();
    }

    /**
     * @param string $odds
     * @param string $parameter
     * @param string $type
     * @param string $league_id
     * @param string $orderBy
     * @param string $order
     *
     * @return \App\Models\Match[]|Collection
     * @throws InvalidArgumentException
     */
    public function search($odds = '', $parameter = '', $type = null, $league_id = null, $orderBy = 'created_at', $order = 'DESC')
    {
        /** @var Match $query */
        $query = $this->match->query();

        $query->where('odds', 'LIKE', $odds.'%');
        $query->where('parameter', 'LIKE', $parameter.'%');
        $query->where('status', '!=', 'waiting');
        $query->where('result', '!=', '');
        if ($type !== null) {
            $query->where('type', $type);
        }
        if ($league_id !== null) {
            $query->where('league_id', $league_id);
        }

        $query->orderBy($orderBy, $order);
        return $query->get();
    }
}