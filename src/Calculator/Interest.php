<?php

namespace Kauri\Loan\Calculator;


use Kauri\Loan\Calculator;

abstract class Interest extends Calculator
{
    abstract public function getInterestAmount($principal, $period);
}