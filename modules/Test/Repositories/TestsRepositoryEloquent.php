<?php

namespace Modules\Test\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Modules\Test\Repositories\TestsRepository;
use Modules\Test\Entities\Tests;
use Modules\Test\Validators\TestsValidator;

/**
 * Class TestsRepositoryEloquent.
 *
 * @package namespace Modules\Test\Repositories;
 */
class TestsRepositoryEloquent extends BaseRepository implements TestsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tests::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
