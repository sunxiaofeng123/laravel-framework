<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/7/15
 * Time: 10:35
 */

namespace Modules\Core\Base;

use Illuminate\Routing\Controller;
use Modules\Core\Response\AppResult;

/**
 * Class BaseController
 * @package Modules\Core\Base
 */
class BaseController extends Controller
{
    /**
     * 数据响应
     * @param $data
     * @param int $status
     * @param string $message
     */
    public function success($data)
    {
        return response()->json(new AppResult($data));
    }

    /**
     * 异常响应
     * @param $error
     */
    public function error(\Exception $error) {
        list($code, $message) = $this->error($error);
        return response()->json(new AppResult([], $code, $message));
    }

    /**
     * 过滤异常
     * @param \Exception $error
     * @return array
     */
    protected function _error(\Exception $error)
    {
        $code    = $error->getCode();
        $message = $error->getMessage();

        return array($code, $message);
    }
}