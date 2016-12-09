<?php

namespace Kauri\Loan\Test;


abstract class InterestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    protected $testData = [];

    /**
     * @return array
     */
    public function loanData()
    {
        return $this->testData;
    }
}
