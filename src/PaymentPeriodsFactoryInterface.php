<?php

namespace Kauri\Loan;


/**
 * Interface PaymentPeriodsFactoryInterface
 * @package Kauri\Loan
 */
interface PaymentPeriodsFactoryInterface
{
    /**
     * PeriodCalculatorInterface constructor.
     * @param PaymentScheduleInterface $paymentSchedule
     * @return PaymentPeriodsInterface
     */
    public static function generate(PaymentScheduleInterface $paymentSchedule);
}