<?php

namespace Sven\SuperBasicAuth\Tests;

use GrahamCampbell\TestBench\AbstractPackageTestCase;

abstract class TestCase extends AbstractPackageTestCase
{
    /**
     * Set up the testing suite.
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Tear down the testing suite.
     */
    public function tearDown(): void
    {
        parent::tearDown();
    }
}
