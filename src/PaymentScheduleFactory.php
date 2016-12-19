<?php

declare(strict_types = 1);

namespace Kauri\Loan;

/**
 * Class PaymentScheduleFactory
 * @package Kauri\Loan
 */
class PaymentScheduleFactory implements PaymentScheduleFactoryInterface
{
    /**
     * @param PaymentScheduleConfigInterface $paymentScheduleConfig
     * @return PaymentScheduleInterface
     */
    public static function generate(PaymentScheduleConfigInterface $paymentScheduleConfig): PaymentScheduleInterface
    {
        $schedule = new PaymentSchedule($paymentScheduleConfig);

        $startDate = $paymentScheduleConfig->getStartDate();
        $dateInterval = $paymentScheduleConfig->getDateInterval();
        $noOfPayments = $paymentScheduleConfig->getNoOfPayments();

        $period = new \DatePeriod($startDate, $dateInterval, $noOfPayments);

        foreach ($period as $iteration => $date) {
            if ($date != $startDate) {
                $schedule->add($date, $iteration);
            }
        }

        return $schedule;
    }
}