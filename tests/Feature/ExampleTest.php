<?php

namespace Tests\Feature;

use Illuminate\Container\Container;
use Illuminate\Support\Facades\DB;
use Modules\Test\Repositories\AfterSaleNoticesRepository;
use Modules\Test\Repositories\UsersRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * 测试查询数据库字段
     */
    public function testTableColumns()
    {
        $columns = DB::select("show full columns from after_sale_notices");

        $filter=['id','created_at','updated_at'];
        $columns = implode(",", array_map(function($item){
            return "'{$item->Field}'";
        }, array_filter(\DB::select("show full columns from after_sale_notices"),function($item)use($filter){
            return !in_array($item->Field,$filter);
        })));

        var_dump($columns);

        DB::update();
    }

    /**
     * 测试修改数据
     *
     */
    public function testUpdate()
    {
//        $user = app(UsersRepository::class)->find(1);
//        $token = JWTAuth::fromUser($user);
//        var_dump($token);
//        $payload = JWTAuth::parseToken()->payload();
//        var_dump($payload);
        $a = $this->test();
        print_r($a);

    }

    private function test()
    {
        try {
            $a = 1;
            return  $a;
        } catch(AntException $exception) {

        } catch(\Exception $exception) {

        } finally {
            echo "先执行一定会执行";
        }
    }
}
