<?php

namespace Kauri\Loan;


interface PaymentAmountCalculatorInterface
{
    /**
     * @param float $presentValue
     * @param float $ratePerPeriod
     * @param float $numberOfPeriods
     * @return float
     */
    public function getPaymentAmount($presentValue, $ratePerPeriod, $numberOfPeriods);
}