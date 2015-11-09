<?php

namespace Itway\Transformers;

use League\Fractal\TransformerAbstract;
use Itway\Models\Event;

/**
 * Class EventTransformer
 * @package namespace Itway\Transformers;
 */
class EventTransformer extends TransformerAbstract
{

    /**
     * Transform the \Event entity
     * @param \Event $model
     *
     * @return array
     */
    public function transform(Event $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
