<?php

namespace App\Http\Controllers;

use App\Decorators\SelectboxDecorator;
use App\Http\Requests;
use App\Http\Requests\SearchRequest;
use App\Models\Match;
use App\Repositories\LeagueRepositoryInterface;
use App\Repositories\MatchRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

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
        $leagues          = $this->leagueRepo->getAllAlpha();
        $decoratedLeagues = with(new SelectboxDecorator($leagues))->prepare();
        $matches          = []; //$this->matchRepo->search();

        $success = 0;
        $fail = 0;

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
        $leagues          = $this->leagueRepo->getAllAlpha();
        $decoratedLeagues = with(new SelectboxDecorator($leagues))->prepare();

        return view('search.list', [
            'types'   => $types,
            'leagues' => $decoratedLeagues,
            'items'   => $matches,
            'success' => $success,
            'fail'    => $fail
        ]);
    }

    public function myGames()
    {
        $matches = $this->matchRepo->findByMyGamesOrFail();
        $result  = [];

        foreach ($matches as $match) {
            $home = $this->matchRepo->groupMatchesByParams([
                'odds'      => $match->odds,
                'parameter' => $match->parameter,
                'type'      => 'home'
            ]);
            $away = $this->matchRepo->groupMatchesByParams([
                'odds'      => $match->odds,
                'parameter' => $match->parameter,
                'type'      => 'away'
            ]);

            $homeWin = $home->filter(function ($v, $k) {
                if ($v->status == Match::STATUS_IN_PLAY) {
                    return true;
                }
            });

            $homeLoose = $home->filter(function ($v, $k) {
                if ($v->status == Match::STATUS_FINISHED) {
                    return true;
                }
            });

            $awayWin = $away->filter(function ($v, $k) {
                if ($v->status == Match::STATUS_IN_PLAY) {
                    return true;
                }
            });

            $awayLoose = $away->filter(function ($v, $k) {
                if ($v->status == Match::STATUS_FINISHED) {
                    return true;
                }
            });

            $result[] = [
                'odds'      => $match->odds,
                'parameter' => $match->parameter,
                'home'      => $this->calculatePercentage($homeWin->count(), $homeLoose->count()),
                'away'      => $this->calculatePercentage($awayWin->count(), $awayLoose->count())
            ];
        }

        return view('my-games.list', [
            'items' => $result,
        ]);
    }

    protected function calculatePercentage($win, $loose)
    {
        $total   = $win + $loose;
        $success = 0;
        $fail    = 0;

        if ($win !== 0 && $loose !== 0) {
            $success = ((($win * 100) / $total) * 100) / 100;
            $fail    = ((($loose * 100) / $total) * 100) / 100;
        } else {
            if ($win !== 0 && $loose == 0) {
                return [
                    'success' => 100,
                    'fail'    => 0
                ];
            } elseif ($loose !== 0 && $win == 0) {
                return [
                    'success' => 0,
                    'fail'    => 100
                ];
            }
        }

        return [
            'success' => $success,
            'fail'    => $fail
        ];
    }
}
