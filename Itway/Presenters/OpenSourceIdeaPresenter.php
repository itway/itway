<?php

namespace Itway\Presenters;

use itway\Transformers\OpenSourceIdeaTransformer;
use RepositoryLab\Repository\Presenter\FractalPresenter;

/**
 * Class OpenSourceIdeaPresenter
 *
 * @package namespace Itway\Presenters;
 */
class OpenSourceIdeaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new OpenSourceIdeaTransformer();
    }
}
