<?php

namespace Itway\Presenters;

use itway\Transformers\TaskBoardTransformer;
use RepositoryLab\Repository\Presenter\FractalPresenter;

/**
 * Class TaskBoardPresenter
 *
 * @package namespace Itway\Presenters;
 */
class TaskBoardPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TaskBoardTransformer();
    }
}
