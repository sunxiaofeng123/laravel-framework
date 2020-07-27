<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/7/27
 * Time: 10:32
 */

namespace Modules\Core\Redis;

/**
 * Redis 缓存 接口
 * Interface IRedisCache
 * @package Modules\Core\Redis
 */
interface IRedisCache
{
    /**
     * 返回连接
     * @return mixed
     */
    public static function conn();

    /**
     * 通过App_name拼接key
     * @return mixed
     */
    public static function coverKey($key);

}