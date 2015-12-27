<?php

namespace Itway\Transformers;

use League\Fractal\TransformerAbstract;
use Itway\Models\PostBody;

/**
 * Class PostBodyTransformer
 * @package namespace Itway\Transformers;
 */
class PostBodyTransformer extends TransformerAbstract
{

    /**
     * Transform the \PostBody entity
     * @param \PostBody $model
     *
     * @return array
     */
    public function transform(PostBody $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
