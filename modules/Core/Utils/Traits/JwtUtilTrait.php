<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/3/19
 * Time: 20:38
 */

namespace Modules\Core\Utils\Traits;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * 生成JWT token trait
 * Trait JwtUtilTrait
 * @package Modules\Core\Util\Traits
 */
trait JwtUtilTrait
{
    /**
     * 生成token
     * @param JWTSubject $user
     * @return string token
     */
    public function generateToken(JWTSubject $user)
    {
        return JWTAuth::fromUser($user);
    }
}