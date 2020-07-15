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
        return response()->json(new AppResult([], $error->getCode(), $error->getMessage()));
    }
}