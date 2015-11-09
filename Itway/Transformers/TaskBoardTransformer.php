<?php

namespace Itway\Transformers;

use League\Fractal\TransformerAbstract;
use Itway\Models\TaskBoard;

/**
 * Class TaskBoardTransformer
 * @package namespace Itway\Transformers;
 */
class TaskBoardTransformer extends TransformerAbstract
{

    /**
     * Transform the \TaskBoard entity
     * @param \TaskBoard $model
     *
     * @return array
     */
    public function transform(TaskBoard $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
