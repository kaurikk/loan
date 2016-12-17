<?php

namespace Kauri\Loan;


class Period implements PeriodInterface
{
    private $start;
    private $end;
    private $length;

    /**
     * Period constructor.
     * @param \DateTime $start
     * @param \DateTime $end
     */
    public function __construct(\DateTime $start, \DateTime $end)
    {
        $this->start = $start;
        $this->end = $end;
        $this->length = self::calculatePeriodLength($start, $end);
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param $periodStart
     * @param $periodEnd
     * @return int
     */
    private static function calculatePeriodLength($periodStart, $periodEnd)
    {
        $diff = (int) $periodEnd->diff($periodStart)->days + 1;
        return $diff;
    }

}