<?php

namespace Kauri\Loan;


class Scheduler
{
    const PAYMENT_FREQUENCY_MONTHLY = 1;
    const PAYMENT_FREQUENCY_WEEKLY = 2;
    const PAYMENT_FREQUENCY_YEARLY = 3;
    /**
     * @var null
     */
    private $yearlyInterestRate = null;
    /**
     * @var null
     */
    private $amountOfPrincipal = null;
    /**
     * @var null
     */
    private $numberOfPayments = null;

    /**
     * @param $amountOfPrincipal
     * @param $numberOfPayments
     * @param $yearlyInterestRate
     */
    public function __construct($amountOfPrincipal, $numberOfPayments, $yearlyInterestRate)
    {
        $this->amountOfPrincipal = $amountOfPrincipal;
        $this->numberOfPayments = $numberOfPayments;
        $this->yearlyInterestRate = $yearlyInterestRate;
    }

    /**
     * @return null
     * @throws Exception
     */
    private function getMonthlyPaymentAmount()
    {
        $periodicInterestRate = $this->getPeriodicInterestRate();

        $periodicPaymentAmount = $this->amountOfPrincipal * (
                $periodicInterestRate + (
                    $periodicInterestRate / (
                        pow(1 + $periodicInterestRate, $this->numberOfPayments) - 1
                    )
                )
            );

        return round($periodicPaymentAmount, 2);
    }

    public function getSchedule()
    {
        $schedule = array();
        $paymentAmount = $this->getMonthlyPaymentAmount();
        $principalLeft = $this->amountOfPrincipal;

        for ($i = 1; $i <= $this->numberOfPayments; $i++) {
            $interest = round($principalLeft * $this->getPeriodicInterestRate(), 2);
            $principal = $paymentAmount - $interest;
            $principalLeft -= $principal;
            $payment = array(
                'payment' => $paymentAmount,
                'principal' => $principal,
                'interest' => $interest,
                'principal_left' => $principalLeft
            );

            $schedule[$i] = $payment;
        }

        return $schedule;
    }

    /**
     * @param int $paymentFrequency
     * @return float
     * @throws Exception
     */
    private function getPeriodicInterestRate($paymentFrequency = self::PAYMENT_FREQUENCY_MONTHLY)
    {
        $dividor = null;

        switch ($paymentFrequency) {
            case self::PAYMENT_FREQUENCY_MONTHLY:
                $dividor = 12;
                break;
            default:
                throw new Exception('Payment frequency support not implemented');
        }

        return $this->yearlyInterestRate / $dividor / 100;
    }
}