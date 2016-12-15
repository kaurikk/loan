<?php

namespace Kauri\Loan;

/**
 * Class RepaymentDateCalculator
 */
class PaymentDateCalculator implements PaymentDateCalculatorInterface
{
    /**
     * @var int
     */
    private $noOfPayments;
    /**
     * @var double
     */
    private $avgIntervalLength;
    /**
     * @var \DateTime
     */
    private $startDate;
    /**
     * @var \DateTime
     */
    private $endDate;
    /**
     * @var array
     */
    private $scheduleDates;

    /**
     * @var string
     */
    private $dateIntervalPattern;

    /**
     * Scheduler constructor.
     * @param $noOfPayments
     * @param \DateTimeInterface $startDate
     * @param $dateIntervalPattern
     */
    public function __construct($noOfPayments, \DateTimeInterface $startDate, $dateIntervalPattern)
    {
        $this->noOfPayments = $noOfPayments;
        $this->startDate = new \DateTime($startDate->format('Y-m-d'), new \DateTimeZone('UTC'));
        $this->dateIntervalPattern = $dateIntervalPattern;
        $this->scheduleDates = $this->generateSchedule();
    }

    /**
     * @return array
     */
    private function generateSchedule()
    {
        $schedule = array();

        $dateInterval = new \DateInterval($this->dateIntervalPattern);
        $this->avgIntervalLength = $this->extractIntervalLength($dateInterval);

        $period = new \DatePeriod($this->startDate, $dateInterval, $this->noOfPayments);

        foreach ($period as $iteration => $date) {
            if ($date != $this->startDate) {
                $schedule[$iteration] = $date;
                $this->endDate = $date;
            }
        }

        return $schedule;
    }

    /**
     * @param \DateInterval $dateInterval
     * @return float
     */
    private function extractIntervalLength(\DateInterval $dateInterval)
    {
        $intervalLength = 0;

        if ($dateInterval->format('%d') > 0) {
            $intervalLength = $intervalLength + $dateInterval->format('%d');
        }
        if ($dateInterval->format('%m') > 0) {
            $intervalLength = $intervalLength + $dateInterval->format('%m') * 30;
        }
        if ($dateInterval->format('%y') > 0) {
            $intervalLength = $intervalLength + $dateInterval->format('%y') * 30 * 12;
        }

        return $intervalLength;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @return array
     */
    public function getSchedule()
    {
        return $this->scheduleDates;
    }

    /**
     * @return int
     */
    public function ggetNoOfPayments()
    {
        return $this->noOfPayments;
    }

    /**
     * @return double
     */
    public function getAvgIntervalLength()
    {
        return $this->avgIntervalLength;
    }

}