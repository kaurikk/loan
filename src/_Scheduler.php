<?php

namespace Kauri\Loan;


use Kauri\Loan\Calculator\Interest\Regular;
use Kauri\Loan\Calculator\Payment\Equal;

class _Scheduler
{
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

    public function getSchedule(InterestCalculatorInterface $interestCalculator, PaymentCalculatorInterface $paymentCalculator)
    {
        /**
         * @todo Move Calculator usages inside of the loop
         */
        $schedule = array();
        $interestCalculator = new Regular($this->yearlyInterestRate);

        $paymentCalculator = new Equal($this->amountOfPrincipal, $this->numberOfPayments, $this->yearlyInterestRate);
        $paymentAmount = round($paymentCalculator->getPaymentAmount(), 2);

        $principalLeft = $this->amountOfPrincipal;

        for ($i = 1; $i <= $this->numberOfPayments; $i++) {
            $interest = round($interestCalculator->getInterestAmount($principalLeft), 2);
            if ($i < $this->numberOfPayments) {
                $principal = $paymentAmount - $interest;
            } else {
                $principal = $principalLeft;
            }
            $principalLeft = round($principalLeft - $principal, 2);
            $payment = array(
                'payment' => $interest + $principal,
                'principal' => $principal,
                'interest' => $interest,
                'principal_left' => $principalLeft
            );

            $schedule[$i] = $payment;
        }

        return $schedule;
    }
}
