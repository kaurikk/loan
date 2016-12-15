<?php

namespace Kauri\Loan;


interface PeriodCalculatorInterface
{
    public function __construct(PaymentDateCalculatorInterface $paymentDateCalculator);

    public function getRatePerPeriod(PeriodInterface $period, $yearlyInterestRate, $calculationType);

    public function getNumberOfPeriods(PeriodInterface $period, $calculationType);
}