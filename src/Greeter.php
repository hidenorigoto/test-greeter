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
        if ($currentTime >= new \DateTimeImmutable('05:00:00') &&
            $currentTime < new \DateTimeImmutable('12:00:00')
        ) {
            return 'おはようございます';
        }

        return '';
    }
}
