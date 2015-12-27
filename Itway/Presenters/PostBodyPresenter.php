<?php

namespace Itway\Presenters;

use itway\Transformers\PostBodyTransformer;
use RepositoryLab\Repository\Presenter\FractalPresenter;

/**
 * Class PostBodyPresenter
 *
 * @package namespace Itway\Presenters;
 */
class PostBodyPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PostBodyTransformer();
    }
}
