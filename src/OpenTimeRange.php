<?php
namespace Hg\Greeter;

class OpenTimeRange extends TimeRange
{
    /**
     * @param \DateTimeInterface $target
     * @return bool
     */
    public function contains(\DateTimeInterface $target): bool
    {
        return $target < $this->first || $this->second <= $target;
    }
}
