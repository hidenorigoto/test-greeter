<?php
namespace Hg\Greeter;

use PHPUnit\Framework\TestCase;

class MorningTimeRangeTest extends TestCase
{
    /**
     * @var MorningTimeRange
     */
    private $SUT;

    /**
     * @test
     * @dataProvider 時間帯テストデータ
     */
    public function 時間帯に含むかどうか($target, $expected)
    {
        $this->assertThat(
            $this->SUT->contains(new \DateTimeImmutable($target)),
            $this->equalTo($expected)
        );
    }

    public function 時間帯テストデータ()
    {
        return [
            ['04:00:00', false],
            ['05:00:00', true],
            ['10:00:00', true],
            ['12:00:00', false],
            ['20:00:00', false],
        ];
    }

    protected function setUp()
    {
        $this->SUT = new MorningTimeRange();
    }
}
