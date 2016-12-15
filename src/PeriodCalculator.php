<?php

namespace Kauri\Loan;


class PeriodCalculator implements PeriodCalculatorInterface
{
    /**
     * Exact payment with exact interest
     */
    const CALCULATION_TYPE_EXACT = 1;
    /**
     * Annuity payment with exact interest
     */
    const CALCULATION_TYPE_EXACT_INTEREST = 2;
    /**
     * Annuity payment with annuity interest
     */
    const CALCULATION_TYPE_ANNUITY = 3;

    private $periods = array();

    private $avgTotalPeriod = null;
    private $exactTotalPeriod = null;

    private $avgCurrentPeriod = null;


    /**
     * PeriodCalculator constructor.
     * @param PaymentDateCalculatorInterface $paymentDateCalculator
     */
    public function __construct(PaymentDateCalculatorInterface $paymentDateCalculator)
    {
        $this->avgCurrentPeriod = $paymentDateCalculator->getAvgIntervalLength();

        $periodStart = clone $paymentDateCalculator->getStartDate();
        foreach ($paymentDateCalculator->getSchedule() as $paymentNo => $paymentDate) {
            $periodStart = $this->calculatePeriodStart($periodStart);
            $periodEnd = $this->calculatePeriodEnd($paymentDate);
            $length = $this->calculatePeriodLength($periodStart, $periodEnd);

            $this->periods[$paymentNo] = new Period($periodStart, $periodEnd, $length);

            $periodStart = clone $paymentDate;
            $this->exactTotalPeriod += $length;
        }

        $this->avgTotalPeriod = $this->avgCurrentPeriod * count($this->periods);
    }

    /**
     * @param PeriodInterface $period
     * @param $yearlyInterestRate
     * @param int $calculationType
     * @return float|int
     * @throws \Exception
     */
    public function getRatePerPeriod(
        PeriodInterface $period,
        $yearlyInterestRate,
        $calculationType = self::CALCULATION_TYPE_ANNUITY
    ) {
        switch ($calculationType) {
            case self::CALCULATION_TYPE_EXACT:
            case self::CALCULATION_TYPE_EXACT_INTEREST:
                $currentPeriod = $period->getLength();
                break;
            case self::CALCULATION_TYPE_ANNUITY:
                $currentPeriod = $this->avgCurrentPeriod;
                break;
            default:
                throw new \Exception('Calculation type not implemented');
        }

        $ratePerPeriod = $yearlyInterestRate / 360 * $currentPeriod;

        return $ratePerPeriod;
    }

    /**
     * @param PeriodInterface $period
     * @param int $calculationType
     * @return float|int
     * @throws \Exception
     */
    public function getNumberOfPeriods(PeriodInterface $period, $calculationType = self::CALCULATION_TYPE_ANNUITY)
    {
        switch ($calculationType) {
            case self::CALCULATION_TYPE_EXACT:
                $currentPeriod = $period->getLength();
                $totalPeriods = $this->exactTotalPeriod;
                break;
            case self::CALCULATION_TYPE_EXACT_INTEREST:
            case self::CALCULATION_TYPE_ANNUITY:
                $currentPeriod = $this->avgCurrentPeriod;
                $totalPeriods = $this->avgTotalPeriod;
                break;
            default:
                throw new \Exception('Calculation type not implemented');
        }

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

    /**
     * @return array
     */
    public function getPeriods()
    {
        return $this->periods;
    }
}