<?php

namespace Kauri\Loan;


interface InterestAmountCalculatorInterface
{
    /**
     * @param float $presentValue
     * @param float $ratePerPeriod
     * @return float
     */
    public function getInterestAmount($presentValue, $ratePerPeriod);
}