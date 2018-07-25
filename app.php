<?php
require_once __DIR__.'/vendor/autoload.php';

use Hg\Greeter\Clock;
use Hg\Greeter\Greeter;
use Hg\Greeter\TimeRangeFactory;

$clock   = new Clock();
$greeter = new Greeter($clock);

$timeRange = new TimeRangeFactory();
$greeter->addTimeRangeAndGreeting($timeRange->create(
    'morning', '05:00:00', '12:00:00'
), 'おはようございます');
$greeter->addTimeRangeAndGreeting($timeRange->create(
    'afternoon', '12:00:00', '18:00:00'
), 'こんにちは');
$greeter->addTimeRangeAndGreeting($timeRange->create(
    'night', '18:00:00', '05:00:00'
), 'こんばんは');

echo $greeter->greet();
