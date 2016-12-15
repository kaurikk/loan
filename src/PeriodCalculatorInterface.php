<?php

namespace Kauri\Loan;


interface PeriodCalculatorInterface
{
    public function __construct(PaymentDateCalculator $paymentDateCalculator);

    public function getRatePerPeriod(Period $period, $yearlyInterestRate);

    public function getNumberOfPeriods(Period $period);
}