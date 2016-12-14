<?php

namespace Kauri\Loan\Test;


use Kauri\Loan\PaymentDateCalculator;
use Kauri\Loan\PeriodCalculator;


class PeriodCalculatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider datesProvider
     * @param $noOfPayments
     * @param \DateTime $startDate
     * @param $dateIntervalPattern
     * @param array $dates
     */
    public function testSomething($noOfPayments, \DateTime $startDate, $dateIntervalPattern, array $dates)
    {
        $scheduler = new PaymentDateCalculator($noOfPayments, $startDate, $dateIntervalPattern);
        $periodCalculator = new PeriodCalculator($scheduler);




    }

    public function datesProvider()
    {
        return [
            //'P1D' => [3, new \DateTime('2000-01-01'), 'P1D', [1 => "2000-01-02", "2000-01-03", "2000-01-04"]],
            //'P3D' => [3, new \DateTime('2000-01-01'), 'P3D', [1 => "2000-01-04", "2000-01-07", "2000-01-10"]],
            'P1M' => [3, new \DateTime('2000-01-01'), 'P1M', [1 => "2000-02-01", "2000-03-01", "2000-04-01"]],
        ];
    }

}
