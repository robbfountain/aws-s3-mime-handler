<?php


namespace OneThirtyOne\Mime\Tests;

use OneThirtyOne\Mime\MimeServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [MimeServiceProvider::class];
    }
}
