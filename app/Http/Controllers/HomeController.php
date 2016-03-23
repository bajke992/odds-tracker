<?php

namespace App\Http\Controllers;

use App\Decorators\SelectboxDecorator;
use App\Http\Requests;
use App\Http\Requests\SearchRequest;
use App\Models\Match;
use App\Repositories\LeagueRepositoryInterface;
use App\Repositories\MatchRepositoryInterface;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /**
     * @var LeagueRepositoryInterface
     */
    private $leagueRepo;
    /**
     * @var MatchRepositoryInterface
     */
    private $matchRepo;

    /**
     * Create a new controller instance.
     *
     * @param LeagueRepositoryInterface $leagueRepo
     * @param MatchRepositoryInterface  $matchRepo
     */
    public function __construct(LeagueRepositoryInterface $leagueRepo, MatchRepositoryInterface $matchRepo)
    {
        $this->leagueRepo = $leagueRepo;
        $this->matchRepo  = $matchRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function search()
    {
        $types            = Match::$VALID_TYPES;
        $leagues          = $this->leagueRepo->getAll();
        $decoratedLeagues = with(new SelectboxDecorator($leagues))->prepare();
        $matches          = []; //$this->matchRepo->search();

        $success = 0;
//        foreach ($matches as $object) {
//            if ($object->getStatus() == Match::STATUS_IN_PLAY) $success++;
//        }
        $fail = 0;
//        foreach ($matches as $object) {
//            if ($object->getStatus() == Match::STATUS_FINISHED) $fail++;
//        }

        return view('search.list', [
            'types'   => $types,
            'leagues' => $decoratedLeagues,
            'items'   => $matches,
            'success' => $success,
            'fail'    => $fail
        ]);
    }

    public function postSearch(SearchRequest $request)
    {
        $input = $request->only([
            'odds',
            'parameter',
            'type',
            'league_id'
        ]);

        $matches = $this->matchRepo->search(
            $input['odds'],
            $input['parameter'],
            $input['type'],
            $input['league_id']
        );

        $success = 0;
        foreach ($matches as $object) {
            if ($object->getStatus() == Match::STATUS_IN_PLAY) $success++;
        }
        $fail = 0;
        foreach ($matches as $object) {
            if ($object->getStatus() == Match::STATUS_FINISHED) $fail++;
        }

        $types            = Match::$VALID_TYPES;
        $leagues          = $this->leagueRepo->getAll();
        $decoratedLeagues = with(new SelectboxDecorator($leagues))->prepare();

        return view('search.list', [
            'types'   => $types,
            'leagues' => $decoratedLeagues,
            'items'   => $matches,
            'success' => $success,
            'fail'    => $fail
        ]);
    }
}
