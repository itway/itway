<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Contracts\RepositoryInterface;
use Itway\Validation\Poll\PollFormRequest;
/**
 * Interface PollRepository
 * @package namespace Itway\Repositories;
 */
interface PollRepository extends RepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel();

    /**
     * @return mixed
     */
    public function countUserPolls();

    /**
     * @param PollFormRequest $request
     * @param $image
     * @return mixed
     */
    public function createPoll(PollFormRequest $request, $image);

    /**
     * @return mixed
     */
    public function todayPolls();

    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @return mixed
     */
    public function getAllUsers();

}
