<?php
namespace Hg\Greeter;

class Greeter
{
    /**
     * @var Clock
     */
    private $clock;
    /**
     * @var array|TimeRange[]
     */
    private $timeRanges = [];
    /**
     * @var array|string[]
     */
    private $greetings = [];
    /**
     * @var Globe
     */
    private $globe;

    public function __construct(Clock $clock, Globe $globe)
    {
        $this->clock = $clock;
        $this->globe = $globe;
    }

    public function addTimeRange(TimeRange $timeRange)
    {
        $this->timeRanges[] = $timeRange;
    }

    public function addGreeting(string $locale, string $timeRangeId, string $greeting)
    {
        $this->greetings[$locale][$timeRangeId] = $greeting;
    }

    /**
     * @return string
     */
    public function greet() :string
    {
        $currentTime   = $this->clock->getCurrentTime();
        $timeRangeId   = $this->decideTimeRange($currentTime);
        $currentLocale = $this->globe->getLocale();

        if (isset($this->greetings[$currentLocale][$timeRangeId])) {
            return $this->greetings[$currentLocale][$timeRangeId];
        }

        return '';
    }

    /**
     * @param \DateTimeInterface $currentTime
     * @return string
     */
    private function decideTimeRange(\DateTimeInterface $currentTime) :string
    {
        foreach ($this->timeRanges as $timeRange) {
            if ($timeRange->contains($currentTime)) {
                return $timeRange->getId();
            }
        }

        throw new \LogicException('Uncovered time range:' . $currentTime->format('H:i'));
    }
}
