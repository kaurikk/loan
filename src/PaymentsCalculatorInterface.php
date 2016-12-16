<?php

namespace Kauri\Loan;


interface PaymentsCalculatorInterface
{
    /**
     * PaymentsCalculatorInterface constructor.
     * @param PaymentPeriodsInterface $paymentPeriods
     * @param PaymentAmountCalculatorInterface $paymentAmountCalculator
     * @param InterestAmountCalculatorInterface $interestAmountCalculator
     * @param float $amountOfPrincipal
     * @param float $yearlyInterestRate
     */
    public function __construct(
        PaymentPeriodsInterface $paymentPeriods,
        PaymentAmountCalculatorInterface $paymentAmountCalculator,
        InterestAmountCalculatorInterface $interestAmountCalculator,
        $amountOfPrincipal,
        $yearlyInterestRate
    );

    /**
     * @return array
     */
    public function getPayments();

}