<?php

namespace Kauri\Loan;


use Kauri\Loan\FinancialCalculator\Interest\Regular;

class RegularInterestTest extends \PHPUnit_Framework_TestCase
{
    public function testGetInterestAmount()
    {
        $calculator = new Regular(360);
        $interest = $calculator->getInterestAmount(100);
        $this->assertEquals(30, $interest);

        $calculator = new Regular(180);
        $interest = $calculator->getInterestAmount(100);
        $this->assertEquals(15, $interest);
    }

}
