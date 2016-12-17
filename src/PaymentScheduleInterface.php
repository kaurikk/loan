<?php

namespace Kauri\Loan;


interface PaymentScheduleInterface
{
    /**
     * PaymentScheduleInterface constructor.
     * @param PaymentScheduleConfigInterface $config
     */
    public function __construct(PaymentScheduleConfigInterface $config);

    /**
     * @param \DateTimeInterface $paymentDate
     * @param null|int $paymentSequenceNo
     */
    public function add(\DateTimeInterface $paymentDate, $paymentSequenceNo = null);

    /**
     * @return PaymentScheduleConfigInterface
     */
    public function getConfig();

    /**
     * @return array
     */
    public function getPaymentDates();

}