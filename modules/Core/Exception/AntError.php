<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/7/7
 * Time: 10:31
 */

namespace Modules\Core\Exception;


use BenSampo\Enum\Enum;

class AntError extends Enum
{
    const SYSTEM_ERROR = [001 => '系统错误'];

    /**
     * 返回code
     * @param array $error
     * @return mixed
     */
    public static function code(array $error)
    {
        return array_keys($error)[0];
    }

    /**
     * 返回异常
     * @param array $error
     * @return string
     */
    public static function message(array $error):string
    {
        return $error[self::code($error)];
    }
}