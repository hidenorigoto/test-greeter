<?php
namespace Hg\Greeter;

use PHPUnit\Framework\TestCase;

class ClosedTimeRangeTest extends TestCase
{
    /**
     * @test
     * @dataProvider 時間帯テストデータ
     */
    public function 時間帯に含むかどうか($first, $second, $target, $expected)
    {
        $timeRange = new ClosedTimeRange('',
            new \DateTimeImmutable($first),
            new \DateTimeImmutable($second));

        $this->assertThat($timeRange->contains(new \DateTimeImmutable($target)),
            $this->equalTo($expected));
    }

    public function 時間帯テストデータ()
    {
        return [
            '時間帯の前'         => ['04:00:00', '10:00:00', '02:00:00', false],
            '時間帯の開始と同一' => ['04:00:00', '10:00:00', '04:00:00', true],
            '時間帯の中'         => ['04:00:00', '10:00:00', '05:00:00', true],
            '時間帯の終了と同一' => ['04:00:00', '10:00:00', '10:00:00', false],
            '時間帯の後'         => ['04:00:00', '10:00:00', '12:00:00', false],
        ];
    }
}
