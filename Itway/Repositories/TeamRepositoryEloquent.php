<?php

namespace Itway\Repositories;

use Auth;
use Countries;
use Illuminate\Support\Str;
use Itway\Commands\CreateTeamCommand;
use Itway\Models\Team;
use Itway\Uploader\ImageTrait;
use Itway\Validation\Poll\PollFormRequest;
use Itway\Validation\Team\TeamRequest;
use Itway\Validation\Team\UpdateTeamRequest;
use Lang;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use RepositoryLab\Repository\Eloquent\BaseRepository;

/**
 * Class TeamRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class TeamRepositoryEloquent extends BaseRepository implements TeamRepository
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

    public function createTeam(TeamRequest $request, $logo)
    {

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
            $this->bindLogoImage($logo, $team);
        }
        if (!is_null($request->trend)) {
            $this->bindTrend($request->trend, $team);
        }
        Auth::user()->attachTeam($team);
        return $team;
    }

    /**
     * @param UpdateTeamRequest $request
     * @param $team
     * @param $logo
     */
    public function updateTeam(UpdateTeamRequest $request, $team, $logo)
    {

        $data = $request->all();

        unset($data['logo_bg']);

        $data['user_id'] = \Auth::id();

        $data['slug'] = Str::slug($data['name']);

        if ($logo) {
            // upload logo image
            $this->bindLogoImage($logo, $team);
        }
        $team->update($data);

        $team->untag();

        $team->tag($request->input('tags_list'));
    }


    /**
     * count users in a team
     */
    public function countUsers()
    {

    }

    public function getCurrentTeam()
    {
        if (!Auth::guest()) {
            $currentTeam = Auth::user()->currentTeam;
        } else {
            $currentTeam = null;
        }
        return $currentTeam;
    }

    public function isTeamMember($team_id, $currentTeam_id)
    {
        if ($team_id == $currentTeam_id) {
            $teamMember = true;
        } else {
            $teamMember = false;
        }
        return $teamMember;
    }

    /**
     * @param PollFormRequest $request
     * @param $team
     */
    public function bindPoll(PollFormRequest $request, $team)
    {

    }

    /**
     * @param array $trends
     * @param $team
     */
    public function bindTrend(array $trends, $team)
    {
        foreach ($trends as $trend) {
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
     * @param $country
     * @return mixed
     */
    public function getCountriesByValue($country)
    {
        $result = Countries::orderBy('name', 'asc')->where('iso_3166_2', strtoupper($country))->select('name')->first();
        return $result->name;
    }

    /**
     * ban or unban instance
     *
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function banORunBan($id)
    {
        try {
            $instance = $this->getModel()->find($id);
            if ($instance->banned === 0) {
                \Toastr::warning(trans('bans.' . strtolower($this->getModelName())), $title = $instance->title, $options = []);
                $instance->banned = true;
            } else {
                \Toastr::info(trans('unbans.' . strtolower($this->getModelName())), $title = $instance->title, $options = []);
                $instance->banned = false;
            }
            $instance->update();
        } catch (\Exception $e) {
            return response("Error appeared. Maybe model doesn't have banned field" . $e->getMessage(), $e->getCode());
        }
    }
}
