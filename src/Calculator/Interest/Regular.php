<?php

namespace Kauri\Loan\Calculator\Interest;


use Kauri\Loan\Calculator\Interest;

class Regular extends Interest
{
    /**
     * @param $principal
     * @param int $period
     * @return mixed
     */
    public function getInterestAmount($principal, $period = 1)
    {
        return parent::getInterestAmount($principal, $period);
    }
}