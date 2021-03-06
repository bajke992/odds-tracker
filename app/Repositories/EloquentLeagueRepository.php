<?php namespace App\Repositories;

use App\Models\League;
use App\Exceptions\EntityNotFoundException;
use Illuminate\Database\Eloquent\Collection;

class EloquentLeagueRepository implements LeagueRepositoryInterface
{

    /**
     * @var League
     */
    private $league;

    /**
     * EloquentLeagueRepository constructor.
     *
     * @param League $league
     */
    public function __construct(League $league)
    {
        $this->league = $league;
    }

    /**
     * @return Collection|League[]
     */
    public function getAll()
    {
        return $this->league->all()->reverse();
    }

    /**
     * @param integer $id
     *
     * @return League|null
     */
    public function find($id)
    {
        return $this->league->query()->find($id);
    }

    /**
     * @param integer $id
     *
     * @return League
     * @throws EntityNotFoundException
     */
    public function findOrFail($id)
    {
        $league = $this->find($id);

        if($league === null) {
            throw new EntityNotFoundException("League not found.");
        }

        return $league;
    }

    /**
     * @param string $name
     *
     * @return Collection|League[]
     */
    public function findByName($name)
    {
        return $this->league->query()->where('name', 'LIKE', '%'.$name.'%')->get();
    }

    /**
     * @param League $league
     */
    public function save(League $league)
    {
        $league->save();
    }

    /**
     * @param League $league
     */
    public function delete(League $league)
    {
        $league->delete();
    }

    /**
     * @return Collection|League[]
     */
    public function getLast5Alpha()
    {
        $query = $this->league->query();
        return $query->orderBy('name')->take(5)->get();

    }

    /**
     * @return Collection|League[]
     */
    public function getAllAlpha()
    {
        $query = $this->league->query();
        return $query->orderBy('name')->get();
    }

    /**
     * @return Collection|League[]
     */
    public function getLast5()
    {
        $query = $this->league->query();
        return $query->orderBy('created_at', 'DESC')->take(5)->get();
    }
}