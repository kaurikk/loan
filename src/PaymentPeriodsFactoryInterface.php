<?php

namespace Kauri\Loan;


interface PaymentPeriodsFactoryInterface
{
    /**
     * PeriodCalculatorInterface constructor.
     * @param PaymentScheduleInterface $paymentSchedule
     * @return PaymentPeriods
     */
    public static function generate(PaymentScheduleInterface $paymentSchedule);
}