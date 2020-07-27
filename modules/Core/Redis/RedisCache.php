<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/7/27
 * Time: 15:45
 */

namespace Modules\Core\Redis;


use Illuminate\Support\Facades\Redis;

class RedisCache extends BaseRedisCache
{
    protected static $conn;

    /**
     * 返回连接
     * @return mixed
     */
    public static function conn()
    {
        if (empty(static::$conn)) {
            static::$conn = Redis::connection('default')->client();
        }

        return static::$conn;
    }


}