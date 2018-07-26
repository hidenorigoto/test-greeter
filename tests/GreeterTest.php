<?php
namespace Hg\Greeter\Tests;

use Hg\Greeter\Clock;
use Hg\Greeter\Globe;
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
     * @var Globe
     */
    private $globe;

    /**
     * @test
     * @dataProvider ロケールごとのあいさつデータ
     */
    public function 最初の時間範囲にマッチ($locale, $one, $two, $three)
    {
        $time = new \DateTimeImmutable();

        $this->clock->expects($this->once())
            ->method('getCurrentTime')
            ->willReturn($time);

        $this->globe->expects($this->once())
            ->method('getLocale')
            ->willReturn($locale);

        $firstTimeRange = $this->getMockBuilder(TimeRange::class)->disableOriginalConstructor()->getMock();
        $firstTimeRange->expects($this->once())
            ->method('contains')
            ->with($time)
            ->willReturn(true);
        $firstTimeRange->expects($this->once())
            ->method('getId')
            ->willReturn('firstrange');

        $secondTimeRange = $this->getMockBuilder(TimeRange::class)->disableOriginalConstructor()->getMock();
        $secondTimeRange->expects($this->never())
            ->method('contains');
        $secondTimeRange->expects($this->never())
            ->method('getId');

        $this->SUT->addTimeRange($firstTimeRange);
        $this->SUT->addTimeRange($secondTimeRange);
        $this->SUT->addGreeting($locale, 'firstrange', $one);
        $this->SUT->addGreeting($locale, 'secondrange', $two);
        $this->SUT->addGreeting($locale, 'thridrange', $three);

        $this->assertThat($this->SUT->greet(), $this->equalTo($one));
    }

    /**
     * @test
     * @dataProvider ロケールごとのあいさつデータ
     */
    public function ニつ目の時間範囲にマッチ($locale, $one, $two, $three)
    {
        $time = new \DateTimeImmutable();

        $this->clock->expects($this->once())
            ->method('getCurrentTime')
            ->willReturn($time);

        $this->globe->expects($this->once())
            ->method('getLocale')
            ->willReturn($locale);

        $firstTimeRange = $this->getMockBuilder(TimeRange::class)->disableOriginalConstructor()->getMock();
        $firstTimeRange->expects($this->once())
            ->method('contains')
            ->with($time)
            ->willReturn(false);
        $firstTimeRange->expects($this->never())
            ->method('getId');

        $secondTimeRange = $this->getMockBuilder(TimeRange::class)->disableOriginalConstructor()->getMock();
        $secondTimeRange->expects($this->once())
            ->method('contains')
            ->with($time)
            ->willReturn(true);
        $secondTimeRange->expects($this->once())
            ->method('getId')
            ->willReturn('secondrange');

        $thirdTimeRange = $this->getMockBuilder(TimeRange::class)->disableOriginalConstructor()->getMock();
        $thirdTimeRange->expects($this->never())
            ->method('contains');
        $thirdTimeRange->expects($this->never())
            ->method('getId');

        $this->SUT->addTimeRange($firstTimeRange);
        $this->SUT->addTimeRange($secondTimeRange);
        $this->SUT->addGreeting($locale, 'firstrange', $one);
        $this->SUT->addGreeting($locale, 'secondrange', $two);
        $this->SUT->addGreeting($locale, 'thridrange', $three);

        $this->assertThat($this->SUT->greet(), $this->equalTo($two));
    }

    /**
     * @test
     * @dataProvider ロケールごとのあいさつデータ
     * @expectedException \LogicException
     */
    public function 時間範囲にマッチしない($locale, $one, $two, $three)
    {
        $time = new \DateTimeImmutable();

        $this->clock->expects($this->once())
            ->method('getCurrentTime')
            ->willReturn($time);

        $this->globe->expects($this->never())
            ->method('getLocale')
            ->willReturn($locale);

        $firstTimeRange = $this->getMockBuilder(TimeRange::class)->disableOriginalConstructor()->getMock();
        $firstTimeRange->expects($this->once())
            ->method('contains')
            ->with($time)
            ->willReturn(false);
        $firstTimeRange->expects($this->never())
            ->method('getId');

        $secondTimeRange = $this->getMockBuilder(TimeRange::class)->disableOriginalConstructor()->getMock();
        $secondTimeRange->expects($this->once())
            ->method('contains')
            ->with($time)
            ->willReturn(false);
        $secondTimeRange->expects($this->never())
            ->method('getId');

        $this->SUT->addTimeRange($firstTimeRange);
        $this->SUT->addTimeRange($secondTimeRange);
        $this->SUT->addGreeting($locale, 'firstrange', $one);
        $this->SUT->addGreeting($locale, 'secondrange', $two);
        $this->SUT->addGreeting($locale, 'thridrange', $three);

        $this->assertThat($this->SUT->greet(), $this->equalTo(''));
    }

    public function ロケールごとのあいさつデータ()
    {
        return [
            '日本語'  => ['ja', 'おはようございます', 'こんにちは', 'こんばんは'],
            '英語'    => ['en', 'Good morning', 'Good afternoon', 'Good evening'],
        ];
    }

    protected function setUp()
    {
        $this->clock = $this->getMockBuilder(Clock::class)->getMock();
        $this->globe = $this->getMockBuilder(Globe::class)->getMock();
        $this->SUT   = new Greeter($this->clock, $this->globe);
    }
}
