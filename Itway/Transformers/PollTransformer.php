<?php

namespace Itway\Transformers;

use League\Fractal\TransformerAbstract;
use Itway\Models\Poll;

/**
 * Class PollTransformer
 * @package namespace Itway\Transformers;
 */
class PollTransformer extends TransformerAbstract
{

    /**
     * Transform the \Poll entity
     * @param \Poll $model
     *
     * @return array
     */
    public function transform(Poll $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
