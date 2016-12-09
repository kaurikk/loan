<?php

namespace Kauri\Loan\FinancialCalculator\Interest;


use Kauri\Loan\FinancialCalculator\Interest;

/**
 * Class Exact
 * @package Kauri\Loan\FinancialCalculator\Interest
 *
 * Calculates interest amount based on exact days in payment
 */
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