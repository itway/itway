<?php

namespace Itway\Repositories;
use Itway\Validation\Team\TeamRequest;
use Itway\Validation\Team\UpdateTeamRequest;
use Itway\Validation\Poll\PollFormRequest;

use RepositoryLab\Repository\Contracts\RepositoryInterface;

/**
 * Interface TeamRepository
 * @package namespace Itway\Repositories;
 */
interface TeamRepository extends RepositoryInterface
{
    public function getModel();
    public function countUsers();
    public function createTeam(TeamRequest $request, $logo);
    public function updateTeam(UpdateTeamRequest $request, $team, $logo);
    public function todayTeams();
    public function getAll();
    public function bindPoll(PollFormRequest $request, $team);
    public function banORunBan($id);

}
