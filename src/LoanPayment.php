<?php

namespace KauriKK\Loan;


class LoanPayment
{
    /**
     * @var \DateTime
     */
    private $paymentDate;
    /**
     * @var \DateTime
     */
    private $periodBeginning;
    /**
     * @var \DateTime
     */
    private $periodEnd;

    public function __construct(\DateTime $periodBeginning, \DateTime $periodEnd)
    {
        $this->periodBeginning = $periodBeginning;
        $this->periodEnd = $this->paymentDate = $periodEnd;
    }

    public function getPaymentDate()
    {
        //
    }

    public function getPaymentAmount()
    {
        //
    }




    public function getPeriodBeginning()
    {
        //
    }

    public function getPeriodEnd()
    {
        //
    }

    public function getStartingPrincipalBalance()
    {
        //
    }

    public function getPrincipal()
    {
        //
    }

    public function setPeriodBeginning()
    {
        //
    }

    public function setPeriodEnd()
    {
        //
    }
}


