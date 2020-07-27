<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/7/27
 * Time: 10:02
 */

namespace Modules\Core\Redis;

use Illuminate\Support\Str;

abstract class BaseRedisCache implements IRedisCache
{
    /**
     * @return mixed
     */
    public abstract static function conn();

    /**
     * 通过App_name拼接key
     * @return mixed
     */
    public static function coverKey($key)
    {
        $appName = env('APP_NAME');

        if (!empty($key) && env('APP_DEBUG')
            && !empty($appName) && !Str::startsWith($key,$appName)) {
            $key = $appName.$key;
        }

        return $key;
    }
}