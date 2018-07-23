<?php
namespace Hg\Greeter;

class MorningTimeRange
{
    public function contains(\DateTimeInterface $target) :bool
    {
        return $target >= new \DateTimeImmutable('05:00:00') &&
            $target < new \DateTimeImmutable('12:00:00');
    }
}
