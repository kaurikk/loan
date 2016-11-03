<?php

class PaymentsCalculator
{
    /**
     * @var array
     */
    private $payments = array();

    /**
     * PaymentsCalculator constructor.
     * @param Scheduler $scheduler
     */
    public function __construct(Scheduler $scheduler)
    {
        $periodStart = clone $scheduler->getStartDate();

        foreach ($scheduler->getSchedule() as $key => $paymentDate) {
            $periodStart = $this->calculatePeriodStart($periodStart);
            $periodEnd = $this->calculatePeriodEnd($paymentDate);
            $diff = $this->calculatePeriodLength($periodStart, $periodEnd);

            $item = array(
                'start' => $periodStart,
                'end' => $periodEnd,
                'period_length' => $diff
            );


            /**
             * @todo Calculate payment amount
             */

            /**
             * @todo Calculate interest part
             */

            /**
             * @todo Calculate principal part
             */

            print_r($item);

            $periodStart = clone $paymentDate;
        }
    }

    /**
     * @param $periodStart
     * @return mixed
     */
    private function calculatePeriodStart($periodStart)
    {
        $periodStart = clone $periodStart;
        // Move to next day
        $periodStart->add(new \DateInterval('P1D'));

        return $periodStart;
    }

    /**
     * @param $paymentDate
     * @return mixed
     */
    private function calculatePeriodEnd($paymentDate)
    {
        $periodEnd = clone $paymentDate;
        // Move to the end of the day
        $periodEnd->add(new \DateInterval('P1D'))->sub(new \DateInterval('PT1S'));
        return $periodEnd;
    }

    private function calculatePeriodLength($periodStart, $periodEnd)
    {
        $diff = (int)$periodEnd->diff($periodStart)->format('%d') + 1;
        return $diff;
    }

}