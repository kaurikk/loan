<?php

namespace Kauri\Loan;


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

    public function add(\DateTime $paymentDate, $paymentSequenceNo = null)
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
     * @return \DateTime
     */
    public function getLastPaymentDate()
    {
        return end($this->paymentDates);
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