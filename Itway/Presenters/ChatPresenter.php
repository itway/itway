<?php

namespace Itway\Presenters;

use itway\Transformers\ChatTransformer;
use RepositoryLab\Repository\Presenter\FractalPresenter;

/**
 * Class ChatPresenter
 *
 * @package namespace Itway\Presenters;
 */
class ChatPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ChatTransformer();
    }
}
