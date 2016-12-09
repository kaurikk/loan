<?php

namespace Kauri\Loan\FinancialCalculator;


use Kauri\Loan\FinancialCalculator;

abstract class Interest extends FinancialCalculator
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