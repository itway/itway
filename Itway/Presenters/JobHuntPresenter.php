<?php

namespace Itway\Presenters;

use itway\Transformers\JobHuntTransformer;
use RepositoryLab\Repository\Presenter\FractalPresenter;

/**
 * Class JobHuntPresenter
 *
 * @package namespace Itway\Presenters;
 */
class JobHuntPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new JobHuntTransformer();
    }
}
