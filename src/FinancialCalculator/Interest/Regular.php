<?php

namespace Kauri\Loan\FinancialCalculator\Interest;


use Kauri\Loan\FinancialCalculator\Interest;

/**
 * Class Regular
 * @package Kauri\Loan\FinancialCalculator\Interest
 *
 * Calculates interest amount based annuity formula (exact number of days is not important)
 */
class Regular extends Interest
{
    /**
     * @param $principal
     * @param int $period
     * @return float
     */
    public function getInterestAmount($principal, $period = 1)
    {
        return parent::getInterestAmount($principal, $period);
    }
}