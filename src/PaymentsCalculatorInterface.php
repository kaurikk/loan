<?php

namespace Kauri\Loan;

/**
 * Interface PaymentsCalculatorInterface
 * @package Kauri\Loan
 */
interface PaymentsCalculatorInterface
{
    /**
     * PaymentsCalculatorInterface constructor.
     * @param PaymentPeriodsInterface $paymentPeriods
     * @param PaymentAmountCalculatorInterface $paymentAmountCalculator
     * @param InterestAmountCalculatorInterface $interestAmountCalculator
     * @param float|int $amountOfPrincipal
     * @param float|int $yearlyInterestRate
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