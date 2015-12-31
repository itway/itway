<?php

namespace Itway\Presenters;

use itway\Transformers\EventsDescriptionTransformer;
use RepositoryLab\Repository\Presenter\FractalPresenter;

/**
 * Class EventsDescriptionPresenter
 *
 * @package namespace Itway\Presenters;
 */
class EventsDescriptionPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new EventsDescriptionTransformer();
    }
}
