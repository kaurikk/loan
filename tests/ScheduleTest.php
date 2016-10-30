<?php

namespace Kauri\Loan;


class ScheduleTest extends \PHPUnit_Framework_TestCase
{

    public function testSchedule()
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
