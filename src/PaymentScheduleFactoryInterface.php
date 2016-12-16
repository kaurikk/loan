<?php

namespace Kauri\Loan;


interface PaymentScheduleFactoryInterface
{
    /**
     * PaymentDateCalculatorInterface constructor.
     * @param PaymentScheduleConfigInterface $config
     * @return PaymentSchedule
     */
    public static function generate(PaymentScheduleConfigInterface $config);
}