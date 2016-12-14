<?php

namespace Kauri\Loan;


class PeriodCalculator implements PeriodCalculatorInterface
{
    const TYPE_CALCULATION_ANNUITY = 1;
    const TYPE_CALCULATION_EXACT = 2;

    private $periods = array();

    private $exactTotalPeriod = null;

    private $avgCurrentPeriod = null;
    private $avgTotalPeriod = null;

    public function __construct(PaymentDateCalculator $paymentDateCalculator)
    {
        $periodStart = clone $paymentDateCalculator->getStartDate();

        foreach ($paymentDateCalculator->getSchedule() as $paymentNo => $paymentDate) {
            $periodStart = $this->calculatePeriodStart($periodStart);
            $periodEnd = $this->calculatePeriodEnd($paymentDate);
            $length = $this->calculatePeriodLength($periodStart, $periodEnd);

            $this->periods[$paymentNo] = new Period($periodStart, $periodEnd, $length);

            $periodStart = clone $paymentDate;
            $this->exactTotalPeriod += $length;
        }

        /**
         * Set average current period based on frequency logic: 30 for monthly, 7 for weekly etc
         * @todo Add support for frequency logic?
         */
        $this->avgCurrentPeriod = null;
        $this->avgTotalPeriod = $this->avgCurrentPeriod * count($this->periods);


        /**
         * Exact payment with exact interest
         * Annuity payment with exact interest
         * Annuity payment with annuity interest
         */


        //$currentPeriod = 30; // average: 30
        //$ratePerPeriod = $yearlyInterestRate / 360 * $currentPeriod;

        //$totalPeriod = $this->calculatePeriodLength($scheduler->getStartDate(), $scheduler->getEndDate()); // exact: 364
        //$totalPeriod = $this->numberOfPayments * 30; // average: 30*

    }

    public function getRatePerPeriod($yearlyInterestRate)
    {
        $currentPeriod = 30; // average: 30
        $ratePerPeriod = $yearlyInterestRate / 360 * $currentPeriod;

        return $ratePerPeriod;
    }

    /**
     * If this is exact then also RatePerPeriod must be exact
     * Is used to calculate payment amount
     * @return float|int
     */
    public function getNumberOfPeriods()
    {
        //$totalPeriod = $this->calculatePeriodLength($scheduler->getStartDate(), $scheduler->getEndDate()); // exact: 364

        $currentPeriod = 30; // average: 30
        $totalPeriods = $this->numberOfPayments * 30; // average: 30

        $numberOfPeriods = $totalPeriods / $currentPeriod;

        return $numberOfPeriods;
    }


    private function calculatePeriodLength($periodStart, $periodEnd)
    {
        $diff = (int) $periodEnd->diff($periodStart)->days + 1;
        return $diff;
    }

    /**
     * @param $periodStart
     * @return mixed
     */
    private function calculatePeriodStart($periodStart)
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
    private function calculatePeriodEnd($paymentDate)
    {
        $periodEnd = clone $paymentDate;
        // Move to the end of the day
        $periodEnd->add(new \DateInterval('P1D'))->sub(new \DateInterval('PT1S'));
        return $periodEnd;
    }

}