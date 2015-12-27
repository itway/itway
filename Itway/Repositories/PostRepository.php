<?php

namespace Itway\Repositories;

use Itway\Validation\Post\PostsUpdateFormRequest;
use RepositoryLab\Repository\Contracts\RepositoryInterface;
use Itway\Validation\Post\PostsFormRequest;
use Itway\Validation\Poll\PollFormRequest;
/**
 * Interface PostRepository
 * @package namespace Itway\Repositories;
 */
interface PostRepository extends RepositoryInterface
{
    public function getModel();
    public function countUserPosts();
    public function createPost(PostsFormRequest $request, $image);
    public function updatePost(PostsUpdateFormRequest $request, $post, $image);
    public function deleteAll($id);
    public function todayPosts();
    public function getAll();
    public function getAllUsers();
    public function bindPoll(PollFormRequest $request, $post);

}
