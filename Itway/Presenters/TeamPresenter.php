<?php

namespace Itway\Presenters;

use itway\Transformers\TeamTransformer;
use RepositoryLab\Repository\Presenter\FractalPresenter;

/**
 * Class TeamPresenter
 *
 * @package namespace Itway\Presenters;
 */
class TeamPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TeamTransformer();
    }
}
