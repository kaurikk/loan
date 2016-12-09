<?php

namespace Kauri\Loan;


abstract class FinancialCalculator
{
    const PAYMENT_FREQUENCY_MONTHLY = 1;
    const PAYMENT_FREQUENCY_WEEKLY = 2;
    const PAYMENT_FREQUENCY_YEARLY = 3;
    const PAYMENT_FREQUENCY_DAILY = 4;

    /**
     * @var
     */
    protected $yearlyInterestRate;

    /**
     * FinancialCalculator constructor.
     * @param $yearlyInterestRate
     */
    public function __construct($yearlyInterestRate)
    {
        $this->yearlyInterestRate = $yearlyInterestRate;
    }

    /**
     * @param int $paymentFrequency
     * @return float
     */
    protected function getPeriodicInterestRate($paymentFrequency = self::PAYMENT_FREQUENCY_MONTHLY)
    {
        switch ($paymentFrequency) {
            case self::PAYMENT_FREQUENCY_MONTHLY:
                $dividor = 12;
                break;
            case self::PAYMENT_FREQUENCY_DAILY:
                $dividor = 360;
                break;
            default:
                throw new Exception('Payment frequency support not implemented');
        }

        return $this->yearlyInterestRate / $dividor / 100;
    }
}