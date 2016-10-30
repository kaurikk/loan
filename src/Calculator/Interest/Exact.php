<?php

namespace Kauri\Loan\Calculator\Interest;


use Kauri\Loan\Calculator\Interest;

class Exact extends Interest
{
    /**
     * @param $principal
     * @param int $period number on days
     * @return mixed
     */
    public function getInterestAmount($principal, $period)
    {
        $periodicInterestRate = $this->getPeriodicInterestRate(self::PAYMENT_FREQUENCY_DAILY);
        $interestAmount = ($principal * $period * $periodicInterestRate);
        return $interestAmount;
    }

}