<?php

namespace Kauri\Loan;

/**
 * Interface PaymentPeriodsInterface
 * @package Kauri\Loan
 */
interface PaymentPeriodsInterface
{
    /**
     * PaymentPeriodsInterface constructor.
     * @param int|float $averagePeriod
     */
    public function __construct($averagePeriod);

    /**
     * @param PeriodInterface $period
     * @param null|int $sequenceNo
     */
    public function add(PeriodInterface $period, $sequenceNo = null);

    /**
     * @param PeriodInterface $period
     * @param float|int $yearlyInterestRate
     * @param int $calculationType
     * @return float|int
     */
    public function getRatePerPeriod(PeriodInterface $period, $yearlyInterestRate, $calculationType);

    /**
     * @param PeriodInterface $period
     * @param int $calculationType
     * @return float|int
     */
    public function getNumberOfPeriods(PeriodInterface $period, $calculationType);

    /**
     * @return array
     */
    public function getPeriods();

    /**
     * @return int
     */
    public function getNoOfPeriods();
}