<?php

namespace Itway\Presenters;

use itway\Transformers\QuizTransformer;
use RepositoryLab\Repository\Presenter\FractalPresenter;

/**
 * Class QuizPresenter
 *
 * @package namespace Itway\Presenters;
 */
class QuizPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new QuizTransformer();
    }
}
