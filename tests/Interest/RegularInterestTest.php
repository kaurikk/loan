<?php

namespace Kauri\Loan\Test;


use Kauri\Loan\FinancialCalculator\Interest\Regular;

class RegularInterestTest extends InterestTest
{
    protected $testData = [
        [360, 100, 30],
        [180, 100, 15]
    ];

    /**
     * @dataProvider loanData
     * @param $principal
     * @param $principalBalance
     * @param $expectedInterest
     */
    public function testGetInterestAmount($principal, $principalBalance, $expectedInterest)
    {
        $calculator = new Regular($principal);
        $interest = $calculator->getInterestAmount($principalBalance);
        $this->assertEquals($expectedInterest, $interest);
    }
}
