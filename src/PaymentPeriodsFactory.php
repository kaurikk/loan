<?php

namespace Kauri\Loan;


class PaymentPeriodsFactory implements PaymentPeriodsFactoryInterface
{
    /**
     * @param PaymentScheduleInterface $paymentSchedule
     * @return PaymentPeriods
     */
    public static function generate(PaymentScheduleInterface $paymentSchedule)
    {
        $periods = new PaymentPeriods($paymentSchedule->getConfig()->getAverageIntervalLength());

        $periodStart = clone $paymentSchedule->getConfig()->getStartDate();

        foreach ($paymentSchedule->getPaymentDates() as $paymentNo => $paymentDate) {
            $periodStart = self::calculatePeriodStart($periodStart);
            $periodEnd = self::calculatePeriodEnd($paymentDate);
            $length = self::calculatePeriodLength($periodStart, $periodEnd);

            $period = new Period($periodStart, $periodEnd, $length);
            $periods->add($period, $paymentNo);

            $periodStart = clone $paymentDate;
        }

        return $periods;
    }

    /**
     * @param $periodStart
     * @param $periodEnd
     * @return int
     */
    private static function calculatePeriodLength($periodStart, $periodEnd)
    {
        $diff = (int) $periodEnd->diff($periodStart)->days + 1;
        return $diff;
    }

    /**
     * @param $periodStart
     * @return mixed
     */
    private static function calculatePeriodStart($periodStart)
    {
        $periodStart = clone $periodStart;
        // Move to next day
        $periodStart->add(new \DateInterval('P1D'));

        return $periodStart;
    }

    /**
     * @param $paymentDate
     * @return mixed
     */
    private static function calculatePeriodEnd($paymentDate)
    {
        $periodEnd = clone $paymentDate;
        // Move to the end of the day
        $periodEnd->add(new \DateInterval('P1D'))->sub(new \DateInterval('PT1S'));
        return $periodEnd;
    }
}