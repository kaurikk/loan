<?php

namespace Kauri\Loan\Calculator\Interest;


use Kauri\Loan\Calculator\Interest;

class Exact extends Interest
{
    /**
     * @param int $paymentFrequency
     * @return float
     */
    protected function getPeriodicInterestRate($paymentFrequency = self::PAYMENT_FREQUENCY_DAILY)
    {
        return parent::getPeriodicInterestRate($paymentFrequency);
    }
}