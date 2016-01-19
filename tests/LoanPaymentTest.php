<?php

namespace KauriKK\Loan;


/**
 * Created by PhpStorm.
 * User: kaurikontkontson
 * Date: 19/01/16
 * Time: 19:37
 */
class LoanPaymentTest extends \PHPUnit_Framework_TestCase
{

    public function testTest()
    {
        $loanPayment = new LoanPayment(new \DateTime('1814-05-17'), new \DateTime('1814-05-30'));

        $this->assertEquals($loanPayment->getPeriodEnd(), $loanPayment->getPaymentDate());
    }
}
