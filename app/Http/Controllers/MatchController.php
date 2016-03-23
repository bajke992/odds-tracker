<?php

namespace App\Http\Controllers;

use App\Decorators\SelectboxDecorator;
use App\Http\Requests;
use App\Http\Requests\CreateMatchRequest;
use App\Http\Requests\DeleteMatchRequest;
use App\Http\Requests\UpdateMatchRequest;
use App\Models\Match;
use App\Repositories\LeagueRepositoryInterface;
use App\Repositories\MatchRepositoryInterface;
use Illuminate\Http\Response;

class MatchController extends Controller
{
    /**
     * @var MatchRepositoryInterface
     */
    private $matchRepo;
    /**
     * @var LeagueRepositoryInterface
     */
    private $leagueRepo;

    /**
     * MatchController constructor.
     *
     * @param MatchRepositoryInterface  $matchRepo
     * @param LeagueRepositoryInterface $leagueRepo
     */
    public function __construct(MatchRepositoryInterface $matchRepo, LeagueRepositoryInterface $leagueRepo)
    {
        $this->matchRepo  = $matchRepo;
        $this->leagueRepo = $leagueRepo;
    }

    /**
     * @return Response
     */
    public function all()
    {
        $matches = $this->matchRepo->getLast5();

        return view('matches.all', [
            'matches' => $matches
        ]);
    }

    /**
     * @return Response
     */
    public function create()
    {
        $match    = new Match();
        $leagues  = $this->leagueRepo->getAll();
        $types    = $match::$VALID_TYPES;
        $statuses = $match::$VALID_STATUSES;

        $decoratedLeagues = with(new SelectboxDecorator($leagues))->prepare();

        return view('matches.form', [
            'match'          => $match,
            'leagues'        => $decoratedLeagues,
            'types'          => $types,
            'statuses'       => $statuses,
            'selectedType'   => null,
            'selectedStatus' => null,
            'selectedLeague' => null
        ]);
    }

    /**
     * @param CreateMatchRequest $request
     *
     * @return Response
     */
    public function postCreate(CreateMatchRequest $request)
    {
        $input = $request->only([
            'odds',
            'result',
            'x',
            'y',
            'comment',
            'type',
            'status',
            'league_id'
        ]);

        $match = Match::make(
            $input['odds'],
            $input['result'],
            $input['x'],
            $input['y'],
            $input['type'],
            $input['status'],
            $this->leagueRepo->findOrFail($input['league_id'])
        );

        if (isset($input['comment']) && ($input['comment'] !== null && $input['comment'] !== '')) {
            $match->setComment($input['comment']);
        }

        $this->matchRepo->save($match);

        session()->flash('message', 'Utakmica je uspešno napravljena!');

        return redirect()->route('matches.home');
    }

    /**
     * @param $id
     *
     * @return Response
     */
    public function update($id)
    {
        $match = $this->matchRepo->findOrFail($id);

        $leagues  = $this->leagueRepo->getAll();
        $types    = $match::$VALID_TYPES;
        $statuses = $match::$VALID_STATUSES;

        $decoratedLeagues = with(new SelectboxDecorator($leagues))->prepare();
        $selectedType     = $match->getType();
        $selectedStatus   = $match->getStatus();
        $selectedLeague   = $match->league->getId();

        return view('matches.form', [
            'match'          => $match,
            'leagues'        => $decoratedLeagues,
            'types'          => $types,
            'statuses'       => $statuses,
            'selectedType'   => $selectedType,
            'selectedStatus' => $selectedStatus,
            'selectedLeague' => $selectedLeague
        ]);
    }

    /**
     * @param UpdateMatchRequest $request
     * @param                    $id
     *
     * @return Response
     */
    public function postUpdate(UpdateMatchRequest $request, $id)
    {
        $input = $request->only([
            'odds',
            'result',
            'x',
            'y',
            'comment',
            'type',
            'status',
            'league_id'
        ]);

        $match = $this->matchRepo->findOrFail($id);

        $match->setOdds($input['odds']);
        $match->setResult($input['result']);
        $match->setX($input['x']);
        $match->setY($input['y']);
        $match->setParameter((float)$input['x'] - (float)$input['y']);
        $match->setType($input['type']);
        $match->setStatus($input['status']);
        $match->setLeagueId($input['league_id']);

        if (isset($input['comment']) && ($input['comment'] !== null && $input['comment'] !== '')) {
            $match->setComment($input['comment']);
        }

        $this->matchRepo->save($match);

        session()->flash('message', 'Odabrana utakmica je uspešno sačuvana!');

        return redirect()->route('matches.home');
    }

    /**
     * @param DeleteMatchRequest $request
     * @param                    $id
     *
     * @return Response
     */
    public function delete(DeleteMatchRequest $request, $id)
    {
        $match = $this->matchRepo->findOrFail($id);
        $this->matchRepo->delete($match);

        session()->flash('message', 'Odabrana utakmica je uspešno obrisana!');

        return redirect()->route('matches.home');
    }
}
