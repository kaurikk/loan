<?php

namespace Kauri\Loan;


interface PaymentPeriodsInterface
{
    public function __construct($averagePeriod);

    public function add(PeriodInterface $period, $sequenceNo = null);

    public function getRatePerPeriod(PeriodInterface $period, $yearlyInterestRate, $calculationType);

    public function getNumberOfPeriods(PeriodInterface $period, $calculationType);

    public function getPeriods();

    public function getNoOfPeriods();
}