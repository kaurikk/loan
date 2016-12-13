<?php

namespace Kauri\Loan;


class InterestAmountCalculator implements InterestAmountCalculatorInterface
{
    /**
     * @param float $presentValue
     * @param float $ratePerPeriod
     * @return float
     */
    public function getInterestAmount($presentValue, $ratePerPeriod)
    {
        $interestAmount = ($presentValue * ($ratePerPeriod / 100));
        return $interestAmount;
    }

}