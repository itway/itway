<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Contracts\RepositoryInterface;
use Itway\Validation\Quiz\QuizFormRequest;

/**
 * Interface QuizRepository
 * @package namespace Itway\Repositories;
 */
interface QuizRepository extends RepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel();

    /**
     * @return mixed
     */
    public function countUserQuizzes();

    /**
     * @param QuizFormRequest $request
     * @param $image
     * @return mixed
     */
    public function createQuiz(QuizFormRequest $request, $image);

    /**
     * @return mixed
     */
    public function todayQuizzes();

    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @return mixed
     */
    public function getAllUsers();


}
