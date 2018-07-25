<?php
namespace Hg\Greeter;

abstract class TimeRange
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var \DateTimeInterface
     */
    private $first;
    /**
     * @var \DateTimeInterface
     */
    private $second;

    public function __construct(string $id, \DateTimeInterface $first, \DateTimeInterface $second)
    {
        $this->first = $first;
        $this->second = $second;
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId() :string
    {
        return $this->id;
    }

    abstract public function contains(\DateTimeInterface $target) :bool;
}
