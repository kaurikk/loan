<?php

namespace Kauri\Loan\Calculator;


use Kauri\Loan\Calculator;

abstract class Interest extends Calculator
{
    /**
     * @param $principal
     * @param int $period
     * @return mixed
     */
    public function getInterestAmount($principal, $period)
    {
        $periodicInterestRate = $this->getPeriodicInterestRate();
        $interestAmount = ($principal * $period * $periodicInterestRate);
        return $interestAmount;
    }
}