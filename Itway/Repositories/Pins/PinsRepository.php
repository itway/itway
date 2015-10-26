<?php

namespace Itway\Repositories\Pins;


use Itway\Repositories\Repository;
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 7/20/2015
 * Time: 1:54 AM
 */
interface PinsRepository  extends Repository
{

    public function getPostModel();
    public function getUserPinnedPosts();
    public function getAllPosts();
}