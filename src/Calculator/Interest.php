<?php

namespace Kauri\Loan\Calculator;


use Kauri\Loan\Calculator;

abstract class Interest extends Calculator
{
    public function getInterestAmount($principal, $period)
    {
        $periodicInterestRate = $this->getPeriodicInterestRate();
        $interestAmount = ($principal * $period * $periodicInterestRate);
        return $interestAmount;
    }
}