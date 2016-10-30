<?php

namespace Kauri\Loan\Calculator;


use Kauri\Loan\Calculator;

abstract class Payment extends Calculator
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