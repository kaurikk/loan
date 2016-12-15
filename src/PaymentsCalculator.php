<?php

namespace Kauri\Loan;


class PaymentsCalculator
{
    /**
     * @var array
     */
    private $payments = array();
    /**
     * @var float
     */
    private $yearlyInterestRate = null;
    /**
     * @var float
     */
    private $amountOfPrincipal = null;
    /**
     * @var integer
     */
    private $numberOfPayments = null;

    /**
     * PaymentsCalculator constructor.
     * @param PaymentDateCalculator $scheduler
     * @param PaymentAmountCalculatorInterface $paymentAmountCalculator
     * @param InterestAmountCalculatorInterface $interestAmountCalculator
     * @param $amountOfPrincipal
     * @param $yearlyInterestRate interest rate for 360 days
     */
    public function __construct(
        PaymentDateCalculator $scheduler,
        PaymentAmountCalculatorInterface $paymentAmountCalculator,
        InterestAmountCalculatorInterface $interestAmountCalculator,
        $amountOfPrincipal,
        $yearlyInterestRate
    ) {
        $this->amountOfPrincipal = $amountOfPrincipal;
        $this->yearlyInterestRate = $yearlyInterestRate;
        $this->numberOfPayments = $scheduler->getNoOfPayments();

        $periodStart = clone $scheduler->getStartDate();
        $principalLeft = $this->amountOfPrincipal;

        foreach ($scheduler->getSchedule() as $key => $paymentDate) {
            $periodStart = $this->calculatePeriodStart($periodStart);
            $periodEnd = $this->calculatePeriodEnd($paymentDate);
            $diff = $this->calculatePeriodLength($periodStart, $periodEnd);


            $currentPeriod = 30; // average: 30
            $ratePerPeriod = $yearlyInterestRate / 360 * $currentPeriod;

            $totalPeriod = $this->numberOfPayments * 30; // average: 30*
            $numberOfPeriods = $totalPeriod / $currentPeriod;

            /**
             * Calculate payment amount
             */
            $paymentAmount = $paymentAmountCalculator->getPaymentAmount($this->amountOfPrincipal, $ratePerPeriod,
                $numberOfPeriods);

            /**
             * Calculate interest part
             */
            $interest = $interestAmountCalculator->getInterestAmount($principalLeft, $ratePerPeriod);

            /**
             * Calculate principal part
             */
            if ($key < $this->numberOfPayments) {
                $principal = $paymentAmount - $interest;
            } else {
                $principal = $principalLeft;
            }

            /**
             * Calculate balance left
             */
            $principalLeft = round($principalLeft - $principal, 2);

            /**
             * Compose payment data
             */
            $paymentData = array(
                'payment' => $interest + $principal,
                'principal' => $principal,
                'interest' => $interest,
                'principal_left' => $principalLeft,
                'period_length' => $diff,
                'period' => array(
                    'start' => $periodStart,
                    'end' => $periodEnd
                )
            );

            $this->payments[$key] = $paymentData;

            $periodStart = clone $paymentDate;
        }
    }

    /**
     * @return array
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * @param $periodStart
     * @return mixed
     */
    private function calculatePeriodStart($periodStart)
    {
        $periodStart = clone $periodStart;
        // Move to next day
        $periodStart->add(new \DateInterval('P1D'));

        return $periodStart;
    }

    /**
     * @param $paymentDate
     * @return mixed
     */
    private function calculatePeriodEnd($paymentDate)
    {
        $periodEnd = clone $paymentDate;
        // Move to the end of the day
        $periodEnd->add(new \DateInterval('P1D'))->sub(new \DateInterval('PT1S'));
        return $periodEnd;
    }

    private function calculatePeriodLength($periodStart, $periodEnd)
    {
        $diff = (int) $periodEnd->diff($periodStart)->format('%d') + 1;
        return $diff;
    }

}