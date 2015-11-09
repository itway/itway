<?php

namespace Itway\Transformers;

use League\Fractal\TransformerAbstract;
use Itway\Models\Quiz;

/**
 * Class QuizTransformer
 * @package namespace Itway\Transformers;
 */
class QuizTransformer extends TransformerAbstract
{

    /**
     * Transform the \Quiz entity
     * @param \Quiz $model
     *
     * @return array
     */
    public function transform(Quiz $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
