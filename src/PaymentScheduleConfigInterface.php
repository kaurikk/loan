<?php

namespace Kauri\Loan;


interface PaymentScheduleConfigInterface
{
    /**
     * PaymentScheduleConfigInterface constructor.
     * @param int $noOfPayments
     * @param \DateTimeInterface $startDate
     * @param string $dateIntervalPattern
     * @param \DateTimeInterface|null $firstPaymentDate
     */
    public function __construct(
        $noOfPayments,
        \DateTimeInterface $startDate,
        $dateIntervalPattern,
        \DateTimeInterface $firstPaymentDate = null
    );

    /**
     * @return int
     */
    public function getNoOfPayments();

    /**
     * @return \DateTimeInterface
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