<?php

namespace Itway\Presenters;

use itway\Transformers\EventUsersTransformer;
use RepositoryLab\Repository\Presenter\FractalPresenter;

/**
 * Class EventUsersPresenter
 *
 * @package namespace Itway\Presenters;
 */
class EventUsersPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new EventUsersTransformer();
    }
}
