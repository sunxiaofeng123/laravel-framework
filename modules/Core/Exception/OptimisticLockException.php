<?php
/**
 * 乐观锁错误
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/3/18
 * Time: 16:07
 */

namespace Modules\Core\Exception;


class OptimisticLockException extends \RuntimeException
{
    protected $model;

    public function setModel($model)
    {
        $this->model   = $model;
        $this->message = " data version mismatch model [{$model}] ";

        return $this;
    }

    public function getModel()
    {
        return $this->model;
    }
}