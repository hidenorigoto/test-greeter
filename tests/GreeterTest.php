<?php
namespace Hg\Greeter\Tests;

use Hg\Greeter\Clock;
use Hg\Greeter\Greeter;
use Hg\Greeter\TimeRange;
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
    public function 最初の時間範囲にマッチ()
    {
        $time = new \DateTimeImmutable();

        $this->clock->expects($this->once())
            ->method('getCurrentTime')
            ->willReturn($time);

        $firstTimeRange = $this->getMockBuilder(TimeRange::class)->disableOriginalConstructor()->getMock();
        $firstTimeRange->expects($this->once())
            ->method('contains')
            ->with($time)
            ->willReturn(true);

        $secondTimeRange = $this->getMockBuilder(TimeRange::class)->disableOriginalConstructor()->getMock();
        $secondTimeRange->expects($this->never())
            ->method('contains');

        $this->SUT->addTimeRangeAndGreeting($firstTimeRange, 'one');
        $this->SUT->addTimeRangeAndGreeting($secondTimeRange, 'two');

        $this->assertThat($this->SUT->greet(), $this->equalTo('one'));
    }

    /**
     * @test
     */
    public function ニつ目の時間範囲にマッチ()
    {
        $time = new \DateTimeImmutable();

        $this->clock->expects($this->once())
            ->method('getCurrentTime')
            ->willReturn($time);

        $firstTimeRange = $this->getMockBuilder(TimeRange::class)->disableOriginalConstructor()->getMock();
        $firstTimeRange->expects($this->once())
            ->method('contains')
            ->with($time)
            ->willReturn(false);

        $secondTimeRange = $this->getMockBuilder(TimeRange::class)->disableOriginalConstructor()->getMock();
        $secondTimeRange->expects($this->once())
            ->method('contains')
            ->with($time)
            ->willReturn(true);

        $thirdTimeRange = $this->getMockBuilder(TimeRange::class)->disableOriginalConstructor()->getMock();
        $thirdTimeRange->expects($this->never())
            ->method('contains');

        $this->SUT->addTimeRangeAndGreeting($firstTimeRange, 'one');
        $this->SUT->addTimeRangeAndGreeting($secondTimeRange, 'two');
        $this->SUT->addTimeRangeAndGreeting($thirdTimeRange, 'three');

        $this->assertThat($this->SUT->greet(), $this->equalTo('two'));
    }

    /**
     * @test
     */
    public function 時間範囲にマッチしない()
    {
        $time = new \DateTimeImmutable();

        $this->clock->expects($this->once())
            ->method('getCurrentTime')
            ->willReturn($time);

        $firstTimeRange = $this->getMockBuilder(TimeRange::class)->disableOriginalConstructor()->getMock();
        $firstTimeRange->expects($this->once())
            ->method('contains')
            ->with($time)
            ->willReturn(false);

        $secondTimeRange = $this->getMockBuilder(TimeRange::class)->disableOriginalConstructor()->getMock();
        $secondTimeRange->expects($this->once())
            ->method('contains')
            ->with($time)
            ->willReturn(false);

        $this->SUT->addTimeRangeAndGreeting($firstTimeRange, 'one');
        $this->SUT->addTimeRangeAndGreeting($secondTimeRange, 'two');

        $this->assertThat($this->SUT->greet(), $this->equalTo(''));
    }

    protected function setUp()
    {
        $this->clock = $this->getMockBuilder(Clock::class)->getMock();
        $this->SUT   = new Greeter($this->clock);
    }
}
