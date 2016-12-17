<?php

namespace Kauri\Loan;


interface PaymentScheduleConfigInterface
{
    public function __construct(
        $noOfPayments,
        \DateTimeInterface $startDate,
        $dateIntervalPattern,
        \DateTimeInterface $firstPaymentDate = null
    );

    /**
     * @return mixed
     */
    public function getNoOfPayments();

    /**
     * @return \DateTime
     */
    public function getStartDate();

    /**
     * @return int
     */
    public function getAverageIntervalLength();

    /**
     * @return \DateInterval
     */
    public function getDateInterval();
}