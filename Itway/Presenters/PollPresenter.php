<?php

namespace Itway\Presenters;

use itway\Transformers\PollTransformer;
use RepositoryLab\Repository\Presenter\FractalPresenter;

/**
 * Class PollPresenter
 *
 * @package namespace Itway\Presenters;
 */
class PollPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PollTransformer();
    }
}
