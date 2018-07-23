<?php
namespace Hg\Greeter\Tests;

use Hg\Greeter\Greeter;
use PHPUnit\Framework\TestCase;

class GreeterTest extends TestCase
{
    /**
     * @var Greeter
     */
    public $SUT;

    /**
     * @test
     */
    public function あいさつする()
    {
        $this->assertThat($this->SUT->greet(), $this->equalTo('おはようございます'));
    }

    protected function setUp()
    {
        $this->SUT = new Greeter();
    }
}
