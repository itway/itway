<?php

namespace Itway\Transformers;

use League\Fractal\TransformerAbstract;
use Itway\Models\JobHunt;

/**
 * Class JobHuntTransformer
 * @package namespace Itway\Transformers;
 */
class JobHuntTransformer extends TransformerAbstract
{

    /**
     * Transform the \JobHunt entity
     * @param \JobHunt $model
     *
     * @return array
     */
    public function transform(JobHunt $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
