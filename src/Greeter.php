<?php
namespace Hg\Greeter;

class Greeter
{
    /**
     * @var Clock
     */
    private $clock;

    public function __construct(Clock $clock)
    {
        $this->clock = $clock;
    }

    public function greet() :string
    {
        $currentTime = $this->clock->getCurrentTime();
        if ($this->timeIsMorning($currentTime)) {
            return 'おはようございます';
        }

        return '';
    }

    /**
     * @param \DateTimeInterface $currentTime
     * @return bool
     */
    private function timeIsMorning(\DateTimeInterface $currentTime) :bool
    {
        return $currentTime >= new \DateTimeImmutable('05:00:00') &&
            $currentTime < new \DateTimeImmutable('12:00:00');
    }
}
