<?php

namespace Kauri\Loan;


use Kauri\Loan\FinancialCalculator\Interest\Regular;

class RegularInterestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider loanData
     * @param $principal
     * @param $principalBalance
     * @param $interestAmount
     */
    public function testGetInterestAmount($principal, $principalBalance, $interestAmount)
    {
        $calculator = new Regular($principal);
        $interest = $calculator->getInterestAmount($principalBalance);
        $this->assertEquals($interestAmount, $interest);
    }

    /**
     * @return array
     */
    public function loanData()
    {
        return [
            [360, 100, 30],
            [180, 100, 15]
        ];
    }

}
