<?php
namespace Hg\Greeter;

class Greeter
{
    /**
     * @var Clock
     */
    private $clock;
    /**
     * @var MorningTimeRange
     */
    private $morningTimeRange;

    public function __construct(Clock $clock, MorningTimeRange $morningTimeRange)
    {
        $this->clock = $clock;
        $this->morningTimeRange = $morningTimeRange;
    }

    public function greet() :string
    {
        $currentTime = $this->clock->getCurrentTime();
        if ($this->morningTimeRange->contains($currentTime)) {
            return 'おはようございます';
        }

        return '';
    }
}
