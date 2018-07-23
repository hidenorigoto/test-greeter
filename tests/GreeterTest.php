<?php
namespace Hg\Greeter\Tests;

use Hg\Greeter\Clock;
use Hg\Greeter\Greeter;
use PHPUnit\Framework\TestCase;

class GreeterTest extends TestCase
{
    /**
     * @var Greeter
     */
    public $SUT;
    /**
     * @var Clock
     */
    private $clock;

    /**
     * @test
     */
    public function あいさつする()
    {
        $this->assertThat($this->SUT->greet(), $this->equalTo('おはようございます'));
    }

    protected function setUp()
    {
        $this->clock = $this->getMockBuilder(Clock::class)->getMock();
        $this->SUT = new Greeter($this->clock);
    }
}
