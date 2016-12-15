<?php

namespace Kauri\Loan;


class Period
{
    private $start;
    private $end;
    private $length;

    public function __construct(\DateTime $start, \DateTime $end, $length)
    {
        $this->start = $start;
        $this->end = $end;
        $this->length = (int) $length;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function getEnd()
    {
        return $this->end;
    }

}