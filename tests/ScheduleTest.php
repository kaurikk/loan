<?php

namespace Kauri\Loan\Test;


use Kauri\Loan\PaymentsCalculator;
use Kauri\Loan\RepaymentDateCalculator;

class ScheduleTest extends \PHPUnit_Framework_TestCase
{

    public function testScheduler()
    {
        $scheduler = new RepaymentDateCalculator(2, new \DateTime(), 'P3D');
        $paymentsCalculator = new PaymentsCalculator($scheduler, 2500, 0);
        $payments = $paymentsCalculator->getPayments();
        $firstPayment = current($payments);
        $this->assertEquals(1250, $firstPayment['payment']);

        $scheduler = new RepaymentDateCalculator(1, new \DateTime(), 'P3D');
        $paymentsCalculator = new PaymentsCalculator($scheduler, 1000, 360);
        $payments = $paymentsCalculator->getPayments();
        $firstPayment = current($payments);
        $this->assertEquals(1300, $firstPayment['payment']);
    }
}
