<?php

namespace Kauri\Loan;


interface PeriodCalculatorInterface
{
    public function __construct(PaymentDateCalculatorInterface $paymentDateCalculator);

    public function getRatePerPeriod(PeriodInterface $period, $yearlyInterestRate);

    public function getNumberOfPeriods(PeriodInterface $period);
}