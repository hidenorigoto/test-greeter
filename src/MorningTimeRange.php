<?php
namespace Hg\Greeter;

class MorningTimeRange
{
    public function contains(\DateTimeInterface $target) :bool
    {
        return true;
    }
}
