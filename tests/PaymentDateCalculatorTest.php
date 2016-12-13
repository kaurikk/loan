<?php

namespace Kauri\Loan\Test;


use Kauri\Loan\PaymentDateCalculator;

class PaymentDateCalculatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider datesProvider
     * @param $noOfPayments
     * @param \DateTime $startDate
     * @param $dateIntervalPattern
     * @param array $dates
     */
    public function testGenerateSchedule($noOfPayments, \DateTime $startDate, $dateIntervalPattern, array $dates)
    {
        $scheduler = new PaymentDateCalculator($noOfPayments, $startDate, $dateIntervalPattern);
        $this->assertEquals($startDate->format('Y-m-d'), $scheduler->getStartDate()->format('Y-m-d'));

        /**
         * @var int $k
         * @var \DateTime $item
         */
        foreach ($scheduler->getSchedule() as $k => $item) {
            $this->assertEquals($item->format('Y-m-d'), $dates[$k]);
        }

        $this->assertEquals(end($dates), $scheduler->getEndDate()->format('Y-m-d'));
    }

    public function datesProvider()
    {
        return [
            'P1D' => [3, new \DateTime('2000-01-01'), 'P1D', [1 => "2000-01-02", "2000-01-03", "2000-01-04"]],
            'P3D' => [3, new \DateTime('2000-01-01'), 'P3D', [1 => "2000-01-04", "2000-01-07", "2000-01-10"]],
            'P1M' => [3, new \DateTime('2000-01-01'), 'P1M', [1 => "2000-02-01", "2000-03-01", "2000-04-01"]],
        ];
    }

}
