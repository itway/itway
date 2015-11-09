<?php

namespace Itway\Transformers;

use League\Fractal\TransformerAbstract;
use Itway\Models\IdeaShare;

/**
 * Class IdeaShareTransformer
 * @package namespace Itway\Transformers;
 */
class IdeaShareTransformer extends TransformerAbstract
{

    /**
     * Transform the \IdeaShare entity
     * @param \IdeaShare $model
     *
     * @return array
     */
    public function transform(IdeaShare $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
