<?php
namespace Hg\Greeter\Tests;

use Hg\Greeter\ClosedTimeRange;
use Hg\Greeter\OpenTimeRange;
use Hg\Greeter\TimeRangeFactory;
use PHPUnit\Framework\TestCase;

class TimeRangeFactoryTest extends TestCase
{
    /**
     * @var TimeRangeFactory
     */
    private $SUT;

    /**
     * @test
     * @dataProvider 時間帯テストデータ
     */
    public function 時間範囲に応じた時間範囲オブジェクトの生成($first, $second, $expectedClass)
    {
        $this->assertThat(
            $this->SUT->create('', $first, $second),
            $this->isInstanceOf($expectedClass)
        );
    }

    public function 時間帯テストデータ()
    {
        return [
            '閉じた時間帯' => ['04:00:00', '10:00:00', ClosedTimeRange::class],
            '開いた時間帯' => ['18:00:00', '05:00:00', OpenTimeRange::class],
        ];
    }

    protected function setUp()
    {
        $this->SUT = new TimeRangeFactory();
    }
}
