<?php

namespace Itway\Repositories;

use Itway\Components\teamwork\Teamwork\TeamworkTeam;
use Itway\Uploader\ImageContract;
use Itway\Uploader\ImageTrait;
use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Models\Team;
use Itway\Validation\Team\TeamRequest;
use Itway\Validation\Team\UpdateTeamRequest;
use Itway\Validation\Poll\PollFormRequest;
use Itway\Commands\CreateTeamCommand;
use Auth;
use Lang;
use Countries;

/**
 * Class TeamRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class TeamRepositoryEloquent extends BaseRepository implements TeamRepository, ImageContract
{
    use ImageTrait;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Team::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }



    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name' => 'like',
        'locale' => 'like',
        'slug' => 'like'
    ];


    /**
     * get the model instance
     *
     * @return mixed
     */
    public function getModel()
    {
        $model = Team::class;

        return new $model;
    }

    /** fetch all paginated, createdAt and localed teams */
    public function getAll()
    {
        return $this->getModel()->localed()->paginate();
    }
    /** fetch the owners team, createdAt and localed teams */
    public function getOwnerTeam()
    {
        return $this->getModel()->localed()->owners()->paginate();
    }
    /**
     * @param TeamRequest $request
     * @param $logo
     * @return mixed
     */

    public function createTeam(TeamRequest $request, $logo){

        $team = $this->dispatcher->dispatch(
            new CreateTeamCommand(
                $request->name,
                Auth::user()->id,
                $request->localed = Lang::locale(),
                $request->tags_list,
                strtoupper($request->country),
                $this->getCountriesByValue($request->country)
              ));
        if (!is_null($logo)) {
            $this->bindImageTo($logo, $team, "logo_bg");
        }
        if (!is_null($request->trend)) {
            $this->bindTrend($request->trend, $team);
        }
        return $team;
    }
    public function updateTeam(UpdateTeamRequest $request, $team, $logo){

        $data = $request->all();

        unset($data['logo_bg']);

        $data['user_id'] = \Auth::id();

        $data['slug'] = Str::slug($data['name']);

        if ($logo) {

            // upload logo image

            if (!is_null($team->logo_bg)) {

                $this->bindImageTo($logo, $team, "logo_bg");
            }

            $team->update($data);

            $team->untag();

            $team->tag($request->input('tags_list'));
        }
        else{
            $team->update($data);

            $team->untag();

            $team->tag($request->input('tags_list'));
        }
    }

    /**
     * count users in a team
     */
    public function countUsers(){

    }

    /**
     * @param PollFormRequest $request
     * @param $team
     */
    public function bindPoll(PollFormRequest $request, $team) {

    }
    /**
     * @param array $trends
     * @param $team
     */
    public function bindTrend(array $trends, $team)
    {
        foreach($trends as $trend)
        {
            $team->trends()->create(['trend' => $trend]);
        }
    }
    /**
     * return the number of today's teams
     *
     * @return mixed
     */
    public function todayTeams()
    {
        return $this->getModel()->today()->count();
    }

    /**
     * ban or unban the team
     *
     * @param $id
     */
    public function banORunBan($id)
    {
        $team = $this->find($id);

        if ($team->banned === 0) {
            \Toastr::warning('Team banned!', $title = $team->name, $options = []);
            $team->banned = true;

        }
        else {
            \Toastr::info('Team unbanned!', $title = $team->name, $options = []);
            $team->banned = false;
        }
        $team->update();
    }

    public function getCountriesByValue($country)
    {
        $result = Countries::orderBy('name', 'asc')->where('iso_3166_2', strtoupper($country))->select('name')->first();
        return $result->name;
    }

}
