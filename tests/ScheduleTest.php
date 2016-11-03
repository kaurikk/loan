<?php

namespace Kauri\Loan;


class ScheduleTest extends \PHPUnit_Framework_TestCase
{

    public function testScheduler()
    {
        $scheduler = new Scheduler(2, new \DateTime(), 'P3D');
        $paymentsCalculator = new PaymentsCalculator($scheduler, 2500, 0);
        $payments = $paymentsCalculator->getPayments();
        $firstPayment = current($payments);
        $this->assertEquals(1250, $firstPayment['payment']);
        print_r($payments);

        $scheduler = new Scheduler(1, new \DateTime(), 'P3D');
        $paymentsCalculator = new PaymentsCalculator($scheduler, 1000, 360);
        $payments = $paymentsCalculator->getPayments();
        $firstPayment = current($payments);
        $this->assertEquals(1300, $firstPayment['payment']);
    }

    public function Schedule()
    {
        $s = new Scheduler(2500, 2, 0);
        $schedule = $s->getSchedule();
        $firstPayment = current($schedule);
        $this->assertEquals(1250, $firstPayment['payment']);


        $s = new Scheduler(1000, 1, 360);
        $schedule = $s->getSchedule();
        $firstPayment = current($schedule);
        $this->assertEquals(1300, $firstPayment['payment']);


        $s = new Scheduler(5630, 60, 9);
        $schedule = $s->getSchedule();
        print_r($schedule);
    }
}
