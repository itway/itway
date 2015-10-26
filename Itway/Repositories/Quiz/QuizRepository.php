<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 08.09.2015
 * Time: 17:38
 */

namespace Itway\Repositories\Quiz;


use Itway\Repositories\Repository;

interface QuizRepository extends Repository {
    public function getModel();
    public function allOrSearchUsers();
}