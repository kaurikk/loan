<?php

namespace Kauri\Loan;


interface PaymentDateCalculatorInterface
{
    /**
     * PaymentDateCalculatorInterface constructor.
     * @param $noOfPayments
     * @param \DateTimeInterface $startDate
     * @param $dateIntervalPattern
     */
    public function __construct($noOfPayments, \DateTimeInterface $startDate, $dateIntervalPattern);

    public function getAvgIntervalLength();

    public function getStartDate();

    public function getSchedule();



}