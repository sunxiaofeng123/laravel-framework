<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
    }
}
