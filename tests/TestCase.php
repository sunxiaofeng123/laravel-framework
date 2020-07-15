<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * 请求header
     */
    protected $header = [
        "Accept"        => "application/psr.ant.v1+json",
        "Content-Type"  => "application/json",
        "Authorization" => ""
    ];

    public function setToken($token)
    {
        $this->header['Authorization'] = "Bearer {$token}";
    }
}
