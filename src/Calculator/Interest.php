<?php

namespace Kauri\Loan\Calculator;


use Kauri\Loan\Calculator;

abstract class Interest extends Calculator
{
    abstract function getInterestAmount($principal, $period);
}