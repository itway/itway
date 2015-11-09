<?php

namespace Itway\Presenters;

use itway\Transformers\IdeaShareTransformer;
use RepositoryLab\Repository\Presenter\FractalPresenter;

/**
 * Class IdeaSharePresenter
 *
 * @package namespace Itway\Presenters;
 */
class IdeaSharePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new IdeaShareTransformer();
    }
}
