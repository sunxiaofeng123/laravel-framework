<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/7/15
 * Time: 11:04
 */

namespace Modules\Core\Response;


class AppResult
{
    /**
     * @var string 状态码
     */
    public $status;

    /**
     * @var $data 数据
     */
    public $data;

    /**
     * @var string $message 说明
     */
    public $message;

    public function __construct($data, $status = 200, $message = 'success')
    {
        $this->data    = $data;
        $this->status  = $status;
        $this->message = $message;
    }


}