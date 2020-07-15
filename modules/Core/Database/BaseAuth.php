<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/3/18
 * Time: 17:41
 */

namespace Modules\Core\Database;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Modules\Core\Database\Traits\OptimisticLockTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class BaseAuth
 * @package Modules\Core\Database
 * token生成继承
 */
abstract class BaseAuth extends Model implements Transformable, JWTSubject
{
    use TransformableTrait;
    //乐观锁特性
    use OptimisticLockTrait;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->primaryKey;
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    abstract public function getJWTCustomClaims();

}