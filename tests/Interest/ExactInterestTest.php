<?php

namespace Kauri\Loan;


use Kauri\Loan\Calculator\Interest\Exact;

class ExactInterestTest extends \PHPUnit_Framework_TestCase
{
    public function testGetInterestAmount()
    {
        $calculator = new Exact(360);
        $interest = $calculator->getInterestAmount(100, 10);
        $this->assertEquals(10, $interest);

        $calculator = new Exact(180);
        $interest = $calculator->getInterestAmount(100, 29);
        $this->assertEquals(14.5, $interest);
    }

}
