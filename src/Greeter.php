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
        return 'おはようございます';
    }
}
