<?php

namespace Kauri\Loan;

/**
 * Class PaymentScheduleFactory
 */
class PaymentScheduleFactory implements PaymentScheduleFactoryInterface
{
    /**
     * @param PaymentScheduleConfigInterface $paymentScheduleConfig
     * @return PaymentSchedule
     */
    public static function generate(PaymentScheduleConfigInterface $paymentScheduleConfig)
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