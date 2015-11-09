<?php

namespace Itway\Presenters;

use itway\Transformers\EventTransformer;
use RepositoryLab\Repository\Presenter\FractalPresenter;

/**
 * Class EventPresenter
 *
 * @package namespace Itway\Presenters;
 */
class EventPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new EventTransformer();
    }
}
