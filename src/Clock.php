<?php
namespace Hg\Greeter;

class Clock
{
    /**
     * @return \DateTimeInterface
     */
    public function getCurrentTime() : \DateTimeInterface
    {
        return new \DateTimeImmutable();
    }
}
