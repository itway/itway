<?php

namespace Itway\Transformers;

use League\Fractal\TransformerAbstract;
use Itway\Models\OpenSourceIdea;

/**
 * Class OpenSourceIdeaTransformer
 * @package namespace Itway\Transformers;
 */
class OpenSourceIdeaTransformer extends TransformerAbstract
{

    /**
     * Transform the \OpenSourceIdea entity
     * @param \OpenSourceIdea $model
     *
     * @return array
     */
    public function transform(OpenSourceIdea $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
