<?php

namespace Kauri\Loan;


class PaymentsCalculator implements PaymentsCalculatorInterface
{
    /**
     * @var array
     */
    private $payments = array();

    /**
     * PaymentsCalculator constructor.
     * @param PeriodCalculatorInterface $periodCalculator
     * @param PaymentAmountCalculatorInterface $paymentAmountCalculator
     * @param InterestAmountCalculatorInterface $interestAmountCalculator
     * @param float $amountOfPrincipal
     * @param float $yearlyInterestRate interest rate for 360 days
     */
    public function __construct(
        PeriodCalculatorInterface $periodCalculator,
        PaymentAmountCalculatorInterface $paymentAmountCalculator,
        InterestAmountCalculatorInterface $interestAmountCalculator,
        $amountOfPrincipal,
        $yearlyInterestRate
    ) {
        $periods = $periodCalculator->getPeriods();
        $numberOfPayments = count($periods);

        $principalLeft = $amountOfPrincipal;

        foreach ($periods as $key => $period) {
            $calculationType = $periodCalculator::CALCULATION_TYPE_ANNUITY;

            $ratePerPeriod = $periodCalculator->getRatePerPeriod($period, $yearlyInterestRate, $calculationType);
            $numberOfPeriods = $periodCalculator->getNumberOfPeriods($period, $calculationType);

            /**
             * Calculate payment amount
             */
            $paymentAmount = $paymentAmountCalculator->getPaymentAmount($amountOfPrincipal, $ratePerPeriod,
                $numberOfPeriods);

            /**
             * Calculate interest part
             */
            $interest = $interestAmountCalculator->getInterestAmount($principalLeft, $ratePerPeriod);

            /**
             * Calculate principal part
             */
            if ($key < $numberOfPayments) {
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
                'period' => $period
            );

            $this->payments[$key] = $paymentData;
        }
    }

    /**
     * @return array
     */
    public function getPayments()
    {
        return $this->payments;
    }
}