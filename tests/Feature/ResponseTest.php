<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/7/15
 * Time: 11:37
 */

namespace Tests\Feature;


use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Core\Base\BaseController;
use Modules\Core\Response\AppResult;
use Modules\Core\Response\PageResult;
use Tests\TestCase;

class ResponseTest extends TestCase
{

    /**
     * 测试响应
     */
    public function testResponse()
    {
        $data = [
            ['name' => '123', 'age' => 12, 'sex' => 1],
            ['name' => '123', 'age' => 12, 'sex' => 1],
            ['name' => '123', 'age' => 12, 'sex' => 1],
            ['name' => '123', 'age' => 12, 'sex' => 1],
            ['name' => '123', 'age' => 12, 'sex' => 1],
            ['name' => '123', 'age' => 12, 'sex' => 1],
        ];
        $page  = 1;
        $limit = 10;
        $total = 5;

        $lengthPage = new LengthAwarePaginator($data, $total, $limit, $page);
        $PageResult = new PageResult($lengthPage);
        $baseController = new BaseController();
        $response = $baseController->success($PageResult);
        print_r($response->getContent());

    }
}