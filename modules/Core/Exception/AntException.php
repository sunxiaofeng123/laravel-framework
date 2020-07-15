<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/3/6
 * Time: 23:25
 */

namespace Modules\Core\Exception;


use Throwable;

class AntException extends \Exception
{
    public function __construct(array $error, Throwable $previous = null)
    {
        parent::__construct(AntError::message($error), (int)AntError::code($error), $previous);
    }
}