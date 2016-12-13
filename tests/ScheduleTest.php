<?php

namespace Kauri\Loan\Test;


use Kauri\Loan\InterestAmountCalculator;
use Kauri\Loan\PaymentAmountCalculator;
use Kauri\Loan\PaymentsCalculator;
use Kauri\Loan\PaymentDateCalculator;

class ScheduleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider loanData
     * @param $noOfPayments
     * @param $principal
     * @param $interestRate
     * @param $expectedPaymentAmount
     */
    public function testScheduler($noOfPayments, $principal, $interestRate, $expectedPaymentAmount)
    {
        $paymentAmountCalculator = new PaymentAmountCalculator;
        $interestAmountCalculator = new InterestAmountCalculator;

        $scheduler = new PaymentDateCalculator($noOfPayments, new \DateTime(), 'P3D');
        $paymentsCalculator = new PaymentsCalculator($scheduler, $paymentAmountCalculator, $interestAmountCalculator,
            $principal, $interestRate);
        $payments = $paymentsCalculator->getPayments();
        $firstPayment = current($payments);
        $this->assertEquals($expectedPaymentAmount, $firstPayment['payment']);
    }

    public function loanData()
    {
        return [
            [2, 2500, 0, 1250],
            [1, 1000, 360, 1300]
        ];
    }
}
