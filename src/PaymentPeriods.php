<?php

namespace Kauri\Loan;


class PaymentPeriods implements PaymentPeriodsInterface
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

    private $totalLength = 0;

    private $averagePeriod;

    private $averageTotalPeriod;

    public function __construct($averagePeriod)
    {
        $this->averagePeriod = $averagePeriod;
    }

    public function add(PeriodInterface $period, $sequenceNo = null)
    {
        $this->periods[$sequenceNo] = $period;
        $this->totalLength = $this->totalLength + $period->getLength();
        $this->averageTotalPeriod = count($this->periods) * $this->averagePeriod;
    }

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
                $currentPeriod = $this->averagePeriod;
                break;
            default:
                throw new \Exception('Calculation type not implemented');
        }

        $ratePerPeriod = $yearlyInterestRate / 360 * $currentPeriod;

        return $ratePerPeriod;
    }

    public function getNumberOfPeriods(PeriodInterface $period, $calculationType = self::CALCULATION_TYPE_ANNUITY)
    {
        switch ($calculationType) {
            case self::CALCULATION_TYPE_EXACT:
                $currentPeriod = $period->getLength();
                $totalPeriods = $this->totalLength;
                break;
            case self::CALCULATION_TYPE_EXACT_INTEREST:
            case self::CALCULATION_TYPE_ANNUITY:
                $currentPeriod = $this->averagePeriod;
                $totalPeriods = $this->averageTotalPeriod;
                break;
            default:
                throw new \Exception('Calculation type not implemented');
        }

        $numberOfPeriods = $totalPeriods / $currentPeriod;

        return $numberOfPeriods;
    }

    public function getPeriods()
    {
        return $this->periods;
    }

    public function getNoOfPeriods()
    {
        return count($this->periods);
    }


}