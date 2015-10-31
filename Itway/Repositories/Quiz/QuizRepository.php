<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 08.09.2015
 * Time: 17:38
 */

namespace Itway\Repositories\Quiz;


use Itway\Validation\Quiz\QuizFormRequest;
use Itway\Repositories\Repository;

interface QuizRepository extends Repository {

    /**
     * @return mixed
     */
    public function getModel();

    /**
     * @return mixed
     */
    public function allOrSearchUsers();

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

}