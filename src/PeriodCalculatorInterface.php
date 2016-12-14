<?php

namespace Kauri\Loan;


interface PeriodCalculatorInterface
{
    public function __construct(PaymentDateCalculator $paymentDateCalculator);

    public function getRatePerPeriod($yearlyInterestRate);

    public function getNumberOfPeriods();
}