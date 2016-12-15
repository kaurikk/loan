<?php

namespace Kauri\Loan;


interface PeriodInterface
{
    public function __construct(\DateTime $start, \DateTime $end, $length);

    public function getLength();

    public function getEnd();

}