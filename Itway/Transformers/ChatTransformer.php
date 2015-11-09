<?php

namespace Itway\Transformers;

use League\Fractal\TransformerAbstract;
use Itway\Models\Chat;

/**
 * Class ChatTransformer
 * @package namespace Itway\Transformers;
 */
class ChatTransformer extends TransformerAbstract
{

    /**
     * @param Chat $model
     * @return array
     */
    public function transform(Chat $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
