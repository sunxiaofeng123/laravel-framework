<?php
namespace Modules\Core\Database;
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/3/6
 * Time: 19:45
 */

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Modules\Core\Database\Traits\OptimisticLockTrait;
/**
 * 基础Entity
 * Class BaseEntity
 */
class BaseEntity extends Model implements  Transformable
{
    use TransformableTrait;
    //乐观锁特性
    use OptimisticLockTrait;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}