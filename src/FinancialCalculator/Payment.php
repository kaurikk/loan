<?php

namespace Kauri\Loan\FinancialCalculator;


use Kauri\Loan\FinancialCalculator;

abstract class Payment extends FinancialCalculator
{
    protected $amountOfPrincipal;

    protected $numberOfPayments;

    public function __construct($amountOfPrincipal, $numberOfPayments, $yearlyInterestRate)
    {
        parent::__construct($yearlyInterestRate);

        $this->amountOfPrincipal = $amountOfPrincipal;
        $this->numberOfPayments = $numberOfPayments;
    }

    abstract public function getPaymentAmount();
}