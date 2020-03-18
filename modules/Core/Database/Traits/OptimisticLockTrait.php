<?php
namespace Modules\Core\Database\Traits;
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/3/6
 * Time: 19:49
 */

use Modules\Core\Exception\OptimisticLockException;
use Illuminate\Support\Arr;

/**
 * Trait OptimisticLockTrait
 * @package Modules\core\Database\Traits
 */
trait OptimisticLockTrait
{

    /**
     * TODO
     * 重写save实现乐观锁
     * Save the model to the database.
     *
     * @param  array  $options
     * @return bool
     */
    public function save(array $options = [])
    {
        //判断模型是否存在, 设置乐观锁参数
        if ($this->exists) {
            $this->__set(
                $this->version_field,
                $this->__get($this->version_field) +1
            );
        } else {
            $this->__set(
                $this->version_field,
                0
            );
        }

        if ($this->fireModelEvent('saving') === false) {
            return false;
        }

        if ($this->exists) {
            $query = $this->newModelQuery();
            //根据锁来查询设置
            if (!Arr::get($options, 'ignore_version', false)) {
                $query->where("id", "=", $this->__get($this->primaryKey))
                    ->where($this->version_field, '=', $this->__get($this->version_field) - 1);
            }

            $saved = $query->update($this->getDirty()) === 1;
        } else {
            $query = $this->newModelQuery();
            $saved = $this->performInsert($query);

            if (! $this->getConnectionName() &&
                $connection = $query->getConnection()) {
                $this->setConnection($connection->getName());
            }
        }

        if ($saved) {
            $this->finishSave($options);
        } else {
            $this->__set(
                $this->version_field,
                $this->__get($this->version_field) - 1
            );

            //抛出异常
            throw (new OptimisticLockException())->setModel($this);
        }

        return $saved;
    }
}