<?php

/**
 * Class Scheduler
 */
class Scheduler
{
    /**
     * @var int
     */
    private $noOfPayments;
    /**
     * @var DateTime
     */
    private $startDate;
    /**
     * @var array
     */
    private $scheduleDates;

    /**
     * Schedule constructor.
     * @param int $noOfPayments
     * @param \DateTimeInterface $startDate
     */
    public function __construct($noOfPayments, \DateTimeInterface $startDate)
    {
        $this->noOfPayments = $noOfPayments;
        $this->startDate = new \DateTime($startDate->format('Y-m-d'), new DateTimeZone('UTC'));
        $this->scheduleDates = $this->generateSchedule();
    }

    /**
     * @return array
     */
    private function generateSchedule()
    {
        $schedule = array();
        $dateInterval = new \DateInterval('P3D');
        $period = new \DatePeriod($this->startDate, $dateInterval, $this->noOfPayments);

        foreach ($period as $iteration => $date) {
            if ($date != $this->startDate) {
                $schedule[$iteration] = $date;
            }
        }

        return $schedule;
    }

    /**
     * @return DateTime
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

}