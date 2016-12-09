<?php

namespace Kauri\Loan\Test;


use Kauri\Loan\FinancialCalculator\Interest\Exact;

class ExactInterestTest extends InterestTest
{
    protected $testData = [
        [360, 100, 10, 10],
        [180, 100, 29, 14.5]
    ];

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
}
