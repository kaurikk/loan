<?php

namespace Kauri\Loan\Test;


use Kauri\Loan\PaymentPeriods;
use Kauri\Loan\Period;


class PaymentPeriodsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider periodsData
     * @param $averagePeriod
     * @param $paymentPeriods
     */
    public function testPaymentPeriods($averagePeriod, $paymentPeriods)
    {
        $periodsCollection = new PaymentPeriods($averagePeriod);
        $noOfPayments = count($paymentPeriods);
        $totalLength = 0;

        $this->assertEquals(0, $periodsCollection->getNoOfPeriods());
        $this->assertTrue(empty($periodsCollection->getPeriods()));

        foreach ($paymentPeriods as $length) {
            $date = new \DateTime('2000-01-01');
            $period = new Period($date, $date, $length);
            $periodsCollection->add($period);
            $totalLength = $totalLength + $length;
        }

        $this->assertEquals($noOfPayments, $periodsCollection->getNoOfPeriods());
        $this->assertTrue(!empty($periodsCollection->getPeriods()));

        $this->assertEquals($totalLength / $length,
            $periodsCollection->getNumberOfPeriods($period, $periodsCollection::CALCULATION_TYPE_EXACT));
        $this->assertEquals($noOfPayments,
            $periodsCollection->getNumberOfPeriods($period, $periodsCollection::CALCULATION_TYPE_EXACT_INTEREST));
        $this->assertEquals($noOfPayments,
            $periodsCollection->getNumberOfPeriods($period, $periodsCollection::CALCULATION_TYPE_ANNUITY));

        $this->assertEquals($length,
            $periodsCollection->getRatePerPeriod($period, 360,
                $periodsCollection::CALCULATION_TYPE_EXACT));
        $this->assertEquals($length,
            $periodsCollection->getRatePerPeriod($period, 360,
                $periodsCollection::CALCULATION_TYPE_EXACT_INTEREST));
        $this->assertEquals($averagePeriod,
            $periodsCollection->getRatePerPeriod($period, 360,
                $periodsCollection::CALCULATION_TYPE_ANNUITY));
    }

    public function periodsData()
    {
        return [
            [7, [6, 5, 3, 9]],
            [30, [29, 30, 31, 30, 28]]
        ];
    }

    /**
     * @expectedException \Exception
     */
    public function testRatePerPeriodException()
    {
        $periodsCollection = new PaymentPeriods(1);
        $periodsCollection->getRatePerPeriod(new Period(new \DateTime(), new \DateTime(), 3), 10, 10);

    }

    /**
     * @expectedException \Exception
     */
    public function testNumberOfPeriodsException()
    {
        $periodsCollection = new PaymentPeriods(1);
        $periodsCollection->getNumberOfPeriods(new Period(new \DateTime(), new \DateTime(), 3), 10);

    }

}
