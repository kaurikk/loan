<?php

namespace Kauri\Loan;

/**
 * Class PaymentSchedule
 * @package Kauri\Loan
 */
class PaymentSchedule implements PaymentScheduleInterface
{
    /**
     * @var array
     */
    private $paymentDates = array();

    /**
     * @var PaymentScheduleConfigInterface
     */
    private $config;

    /**
     * PaymentSchedule constructor.
     * @param PaymentScheduleConfigInterface $config
     */
    public function __construct(PaymentScheduleConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * @param \DateTimeInterface $paymentDate
     * @param null|int $paymentSequenceNo
     */
    public function add(\DateTimeInterface $paymentDate, $paymentSequenceNo = null)
    {
        $this->paymentDates[$paymentSequenceNo] = $paymentDate;
    }

    /**
     * @return array
     */
    public function getPaymentDates()
    {
        return $this->paymentDates;
    }

    /**
     * @return int
     */
    public function getNoOfPayments()
    {
        return (int) count($this->paymentDates);
    }

    /**
     * @return PaymentScheduleConfigInterface
     */
    public function getConfig()
    {
        return $this->config;
    }

}