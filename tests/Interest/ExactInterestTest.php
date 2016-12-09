<?php

namespace Kauri\Loan;


use Kauri\Loan\FinancialCalculator\Interest\Exact;

class ExactInterestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider loanData
     * @param $principal
     * @param $principalBalance
     * @param $noOfDays
     * @param $expectedInterest
     */
    public function testGetInterestAmount($principal, $principalBalance, $noOfDays, $expectedInterest)
    {
        $calculator = new Exact($principal);
        $interest = $calculator->getInterestAmount($principalBalance, $noOfDays);
        $this->assertEquals($expectedInterest, $interest);
    }

    public function loanData()
    {
        return [
            [360, 100, 10, 10],
            [180, 100, 29, 14.5]
        ];
    }

}
