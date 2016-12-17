<?php

namespace Kauri\Loan;


interface PeriodInterface
{
    public function __construct(\DateTime $start, \DateTime $end);

    public function getLength();

    public function getEnd();

}