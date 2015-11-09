<?php

namespace Itway\Transformers;

use League\Fractal\TransformerAbstract;
use Itway\Models\Post;

/**
 * Class PostTransformer
 * @package namespace Itway\Transformers;
 */
class PostTransformer extends TransformerAbstract
{

    /**
     * Transform the \Post entity
     * @param \Post $model
     *
     * @return array
     */
    public function transform(Post $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
