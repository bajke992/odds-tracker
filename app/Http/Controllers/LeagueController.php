<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateLeagueRequest;
use App\Http\Requests\DeleteLeagueRequest;
use App\Http\Requests\UpdateLeagueRequest;
use App\Models\League;
use App\Repositories\LeagueRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class LeagueController extends Controller
{
    /**
     * @var LeagueRepositoryInterface
     */
    private $leagueRepo;

    /**
     * LeagueController constructor.
     *
     * @param LeagueRepositoryInterface $leagueRepo
     */
    public function __construct(LeagueRepositoryInterface $leagueRepo)
    {
        $this->leagueRepo = $leagueRepo;
    }

    /**
     * @return Response
     */
    public function all()
    {
        $leagues = $this->leagueRepo->getLast5Alpha();

        return view('leagues.all', [
            'leagues' => $leagues
        ]);
    }

    /**
     * @return Response
     */
    public function create()
    {
        $league = new League;

        return view('leagues.form', [
            'league' => $league
        ]);
    }

    /**
     * @param CreateLeagueRequest $request
     *
     * @return RedirectResponse
     */
    public function postCreate(CreateLeagueRequest $request)
    {
        $input = $request->only('name');

        $league = League::make($input['name']);

        $this->leagueRepo->save($league);

        session()->flash('message', 'Liga je uspešno napravljena!');

        return redirect()->route('leagues.home');
    }

    /**
     * @param $id
     *
     * @return Response
     */
    public function update($id)
    {
        $league = $this->leagueRepo->findOrFail($id);

        return view('leagues.form', [
            'league' => $league
        ]);
    }

    /**
     * @param UpdateLeagueRequest $request
     * @param                     $id
     *
     * @return Response
     */
    public function postUpdate(UpdateLeagueRequest $request, $id)
    {
        $input = $request->only('name');

        $league = $this->leagueRepo->findOrFail($id);

        $league->setName($input['name']);

        $this->leagueRepo->save($league);

        session()->flash('message', 'Odabrana liga je uspešno sačuvana!');

        return redirect()->route('leagues.home');
    }

    /**
     * @param DeleteLeagueRequest $request
     *
     * @return Response
     */
    public function delete(DeleteLeagueRequest $request, $id)
    {
        $league = $this->leagueRepo->findOrFail($id);

        if (count($league->matches) !== 0) {
            session()->flash('error', 'Odabrana liga nije obrisana! Liga nije prazna, prebaci utakmice ili ih obrisi.');
            return redirect()->route('leagues.home');
        }

        $this->leagueRepo->delete($league);

        session()->flash('message', 'Odabrana liga je uspešno obrisana!');

        return redirect()->route('leagues.home');
    }
}
