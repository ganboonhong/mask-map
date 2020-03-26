<?php
namespace app\tests\unit\models;

use app\models\Pharmacy;
use Codeception\Test\Unit;

class PharmacyTest extends Unit
{
    public function testSync()
    {
        $pharmacy = $this->make(new Pharmacy);
        $pharmacy = new Pharmacy;
        $actual = $pharmacy->sync();
        $this->assertIsInt($actual);
    }
}
