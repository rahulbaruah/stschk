<?php

namespace Rahxcr\LaravelStschk\Tests;

use Orchestra\Testbench\TestCase;
use Rahxcr\LaravelStschk\LaravelStschkServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [LaravelStschkServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
