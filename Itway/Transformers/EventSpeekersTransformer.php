<?php

namespace Itway\Transformers;

use League\Fractal\TransformerAbstract;
use Itway\Models\EventSpeekers;

/**
 * Class EventSpeekersTransformer
 * @package namespace Itway\Transformers;
 */
class EventSpeekersTransformer extends TransformerAbstract
{

    /**
     * Transform the \EventSpeekers entity
     * @param \EventSpeekers $model
     *
     * @return array
     */
    public function transform(EventSpeekers $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
