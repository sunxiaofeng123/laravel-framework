<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/7/22
 * Time: 17:17
 */

namespace Modules\Core\Service;


use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Validator\LaravelValidator;

class BaseService
{
    /**
     * 数据仓库
     * @var \Prettus\Repository\Eloquent\BaseRepository
     */
    public $repository;

    /**
     * @var \Prettus\Validator\LaravelValidator
     */
    public $validator;

    /**
     * BaseService constructor.
     * @param BaseRepository $repository
     * @param LaravelValidator $validator
     */
    public function __construct(BaseRepository $repository, LaravelValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


}