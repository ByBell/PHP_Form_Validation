<?php

namespace App\Tests;

use App\Service\Bleech;
use PHPUnit\Framework\TestCase;

class BleechTest extends TestCase
{
    public function testAge()
    {
        $b = new Bleech();
        $this->assertEquals($b->getAge(new \DateTime("now - 15 years")), 15);
    }
}
