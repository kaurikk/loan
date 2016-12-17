<?php

namespace Kauri\Loan;

/**
 * Class PaymentPeriods
 * @package Kauri\Loan
 */
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

    /**
     * @var array
     */
    private $periods = array();
    /**
     * @var int
     */
    private $totalLength = 0;
    /**
     * @var float|int
     */
    private $averagePeriod;
    /**
     * @var int
     */
    private $averageTotalPeriod;

    /**
     * PaymentPeriods constructor.
     * @param float|int $averagePeriod
     */
    public function __construct($averagePeriod)
    {
        $this->averagePeriod = $averagePeriod;
    }

    /**
     * @param PeriodInterface $period
     * @param null|int $sequenceNo
     */
    public function add(PeriodInterface $period, $sequenceNo = null)
    {
        if (is_null($sequenceNo)) {
            $sequenceNo = $this->getNoOfPeriods() + 1;
        }
        $this->periods[$sequenceNo] = $period;
        $this->totalLength = $this->totalLength + $period->getLength();
        $this->averageTotalPeriod = count($this->periods) * $this->averagePeriod;
    }

    /**
     * @param PeriodInterface $period
     * @param float|int $yearlyInterestRate
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
                $currentPeriod = $this->averagePeriod;
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

    /**
     * @return array
     */
    public function getPeriods()
    {
        return $this->periods;
    }

    /**
     * @return int
     */
    public function getNoOfPeriods()
    {
        return count($this->periods);
    }


}