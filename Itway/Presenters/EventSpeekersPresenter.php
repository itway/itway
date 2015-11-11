<?php

namespace Itway\Presenters;

use itway\Transformers\EventSpeekersTransformer;
use RepositoryLab\Repository\Presenter\FractalPresenter;

/**
 * Class EventSpeekersPresenter
 *
 * @package namespace Itway\Presenters;
 */
class EventSpeekersPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new EventSpeekersTransformer();
    }
}
