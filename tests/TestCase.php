<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function assertClassUsesTrait($trait, $class)
    {
        $this->assertArrayHasKey(
            $trait,
            class_uses($class),
            sprintf('[%s] class must use [%s] trait', $class, $trait)
        );
    }
}
