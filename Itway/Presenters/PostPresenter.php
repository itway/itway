<?php

namespace Itway\Presenters;

use itway\Transformers\PostTransformer;
use RepositoryLab\Repository\Presenter\FractalPresenter;

/**
 * Class PostPresenter
 *
 * @package namespace Itway\Presenters;
 */
class PostPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PostTransformer();
    }
}
