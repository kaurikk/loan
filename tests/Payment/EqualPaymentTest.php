<?php

namespace Kauri\Loan;

use Kauri\Loan\Calculator\Payment\Equal;

class EqualPaymentTest extends \PHPUnit_Framework_TestCase
{
    public function testGetPaymentAmount()
    {
        $paymentCalculator = new Equal(1000, 2, 0);
        $paymentAmount = $paymentCalculator->getPaymentAmount();
        $this->assertEquals(500, $paymentAmount);

        $paymentCalculator = new Equal(5630, 60, 9);
        $paymentAmount = $paymentCalculator->getPaymentAmount();
        $this->assertEquals(116.87, round($paymentAmount, 2));
    }
}
