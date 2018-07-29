<?php

namespace Tests\Feature;

use Lib\Fz\src\Test;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class dyTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExampleTest()
    {
//        $this->assertTrue(true);
        $t = app('Lib\Fz\src\Test');
        $t->str = '123456';

        $this->assertEquals(
            '123456',
            $t->run()
        );
    }
}
