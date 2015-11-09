<?php

namespace Itway\Transformers;

use League\Fractal\TransformerAbstract;
use Itway\Models\Team;

/**
 * Class TeamTransformer
 * @package namespace Itway\Transformers;
 */
class TeamTransformer extends TransformerAbstract
{

    /**
     * Transform the \Team entity
     * @param \Team $model
     *
     * @return array
     */
    public function transform(Team $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
