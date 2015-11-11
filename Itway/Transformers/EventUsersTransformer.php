<?php

namespace Itway\Transformers;

use League\Fractal\TransformerAbstract;
use Itway\Models\EventUsers;

/**
 * Class EventUsersTransformer
 * @package namespace Itway\Transformers;
 */
class EventUsersTransformer extends TransformerAbstract
{

    /**
     * Transform the \EventUsers entity
     * @param \EventUsers $model
     *
     * @return array
     */
    public function transform(EventUsers $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
