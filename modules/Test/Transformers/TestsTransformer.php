<?php

namespace Modules\Test\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Test\Entities\Tests;

/**
 * Class TestsTransformer.
 *
 * @package namespace Modules\Test\Transformers;
 */
class TestsTransformer extends TransformerAbstract
{
    /**
     * Transform the Tests entity.
     *
     * @param \Modules\Test\Entities\Tests $model
     *
     * @return array
     */
    public function transform(Tests $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
