<?php

namespace Kauri\Loan;


class PaymentScheduleConfig implements PaymentScheduleConfigInterface
{
    private $noOfPayments;
    private $startDate;
    private $averageIntervalLength = 0;
    private $dateInterval;
    private $firstPaymentDate;

    /**
     * PaymentScheduleConfig constructor.
     * @param $noOfPayments
     * @param \DateTimeInterface $startDate
     * @param $dateIntervalPattern
     * @param \DateTimeInterface|null $firstPaymentDate
     */
    public function __construct(
        $noOfPayments,
        \DateTimeInterface $startDate,
        $dateIntervalPattern,
        \DateTimeInterface $firstPaymentDate = null
    ) {
        $this->noOfPayments = $noOfPayments;
        $this->startDate = new \DateTime($startDate->format('Y-m-d'), new \DateTimeZone('UTC'));

        if (!is_null($firstPaymentDate)) {
            $this->firstPaymentDate = new \DateTime($firstPaymentDate->format('Y-m-d'), new \DateTimeZone('UTC'));
        }

        $this->dateInterval = new \DateInterval($dateIntervalPattern);

        $this->averageIntervalLength = $this->extractIntervalLength($this->dateInterval);
    }

    /**
     * @param \DateInterval $dateInterval
     * @return int
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
     * @return mixed
     */
    public function getNoOfPayments()
    {
        return $this->noOfPayments;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @return int
     */
    public function getAverageIntervalLength()
    {
        return $this->averageIntervalLength;
    }

    /**
     * @return \DateInterval
     */
    public function getDateInterval()
    {
        return $this->dateInterval;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getFirstPaymentDate()
    {
        return $this->firstPaymentDate;
    }
}