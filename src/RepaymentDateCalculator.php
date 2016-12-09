<?php

namespace Kauri\Loan;

/**
 * Class RepaymentDateCalculator
 */
class RepaymentDateCalculator
{
    /**
     * @var int
     */
    private $noOfPayments;
    /**
     * @var \DateTime
     */
    private $startDate;
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
        $period = new \DatePeriod($this->startDate, $dateInterval, $this->noOfPayments);

        foreach ($period as $iteration => $date) {
            if ($date != $this->startDate) {
                $schedule[$iteration] = $date;
            }
        }

        return $schedule;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
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
    public function getNoOfPayments()
    {
        return $this->noOfPayments;
    }

}