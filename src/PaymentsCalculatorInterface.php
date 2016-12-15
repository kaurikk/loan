<?php

namespace Kauri\Loan;


interface PaymentsCalculatorInterface
{
    /**
     * PaymentsCalculatorInterface constructor.
     * @param PeriodCalculatorInterface $periodCalculator
     * @param PaymentAmountCalculatorInterface $paymentAmountCalculator
     * @param InterestAmountCalculatorInterface $interestAmountCalculator
     * @param float $amountOfPrincipal
     * @param float $yearlyInterestRate
     */
    public function __construct(
        PeriodCalculatorInterface $periodCalculator,
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