<?php
require_once __DIR__.'/vendor/autoload.php';

use Hg\Greeter\Clock;
use Hg\Greeter\Globe;
use Hg\Greeter\Greeter;
use Hg\Greeter\TimeRangeFactory;

$clock   = new Clock();
$globe   = new Globe();
$greeter = new Greeter($clock, $globe);

$timeRange = new TimeRangeFactory();
$greeter->addTimeRange($timeRange->create(
    'morning', '05:00:00', '12:00:00'
));
$greeter->addTimeRange($timeRange->create(
    'afternoon', '12:00:00', '18:00:00'
));
$greeter->addTimeRange($timeRange->create(
    'night', '18:00:00', '05:00:00'
));

$greeter->addGreeting('ja', 'morning',   'おはようございます');
$greeter->addGreeting('ja', 'afternoon', 'こんにちは');
$greeter->addGreeting('ja', 'night',     'こんばんは');
$greeter->addGreeting('en', 'morning',   'Good morning');
$greeter->addGreeting('en', 'afternoon', 'Good afternoon');
$greeter->addGreeting('en', 'night',     'Good evening');

echo $greeter->greet();
