<?php

namespace Kauri\Loan;


class PaymentAmountCalculator implements PaymentAmountCalculatorInterface
{
    /**
     * @see http://www.financeformulas.net/Annuity_Payment_Formula.html
     * @param float $presentValue
     * @param float $ratePerPeriod
     * @param float $numberOfPeriods
     * @return float
     */
    public function getPaymentAmount($presentValue, $ratePerPeriod, $numberOfPeriods)
    {
        if ($ratePerPeriod > 0) {
            $payment = (($ratePerPeriod / 100) * $presentValue) / (1 - pow(1 + ($ratePerPeriod / 100),
                        -$numberOfPeriods));
        } else {
            $payment = $presentValue / $numberOfPeriods;
        }

        return $payment;
    }
}