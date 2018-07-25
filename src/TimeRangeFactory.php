<?php
namespace Hg\Greeter;

class TimeRangeFactory
{
    /**
     * @param string $id
     * @param string $start
     * @param string $end
     * @return TimeRange
     */
    public function create(string $id, string $start, string $end) :TimeRange
    {
        $startTimeObj = new \DateTimeImmutable($start);
        $endTimeObj   = new \DateTimeImmutable($end);

        if ($startTimeObj < $endTimeObj) {
            return new ClosedTimeRange($id, $startTimeObj, $endTimeObj);
        } else {
            return new OpenTimeRange($id, $endTimeObj, $startTimeObj);
        }
    }
}
