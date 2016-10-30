<?php

namespace Kauri\Loan\Calculator\Payment;


use Kauri\Loan\Calculator\Payment;

class Equal extends Payment
{
    public function getPaymentAmount()
    {
        $periodicInterestRate = $this->getPeriodicInterestRate();

        if ($periodicInterestRate > 0) {
            $periodicPaymentAmount = $this->amountOfPrincipal * (
                    $periodicInterestRate + (
                        $periodicInterestRate / (
                            pow(1 + $periodicInterestRate, $this->numberOfPayments) - 1
                        )
                    )
                );
        } else {
            $periodicPaymentAmount = $this->amountOfPrincipal / $this->numberOfPayments;
        }

        return $periodicPaymentAmount;
    }
}