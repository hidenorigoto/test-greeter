<?php
namespace Hg\Greeter\Tests;

use Hg\Greeter\Clock;
use Hg\Greeter\Greeter;
use Hg\Greeter\MorningTimeRange;
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
     * @var MorningTimeRange
     */
    private $morningTimeRange;

    /**
     * @test
     */
    public function 朝ならおはようございます()
    {
        $this->clock->expects($this->once())
            ->method('getCurrentTime')
            ->willReturn($current = new \DateTimeImmutable('08:00:00'));
        $this->morningTimeRange->expects($this->once())
            ->method('contains')
            ->with($current)
            ->willReturn(true);

        $this->assertThat($this->SUT->greet(), $this->equalTo('おはようございます'));
    }

    /**
     * @test
     */
    public function 朝でないならあいさつなし()
    {
        $this->clock->expects($this->once())
            ->method('getCurrentTime')
            ->willReturn($current = new \DateTimeImmutable('15:00:00'));
        $this->morningTimeRange->expects($this->once())
            ->method('contains')
            ->with($current)
            ->willReturn(false);

        $this->assertThat($this->SUT->greet(), $this->equalTo(''));
    }

    protected function setUp()
    {
        $this->clock = $this->getMockBuilder(Clock::class)->getMock();
        $this->morningTimeRange = $this->getMockBuilder(MorningTimeRange::class)->getMock();
        $this->SUT = new Greeter($this->clock, $this->morningTimeRange);
    }
}
