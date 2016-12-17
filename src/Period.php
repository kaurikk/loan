<?php

namespace Kauri\Loan;

/**
 * Class Period
 * @package Kauri\Loan
 */
class Period implements PeriodInterface
{
    /**
     * @var \DateTimeInterface
     */
    private $start;
    /**
     * @var \DateTimeInterface
     */
    private $end;
    /**
     * @var int
     */
    private $length;

    /**
     * Period constructor.
     * @param \DateTimeInterface $start
     * @param \DateTimeInterface $end
     */
    public function __construct(\DateTimeInterface $start, \DateTimeInterface $end)
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
     * @return \DateTimeInterface
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param \DateTimeInterface $periodStart
     * @param \DateTimeInterface $periodEnd
     * @return int
     */
    private static function calculatePeriodLength(\DateTimeInterface$periodStart, \DateTimeInterface $periodEnd)
    {
        $diff = (int) $periodEnd->diff($periodStart)->days + 1;
        return $diff;
    }

}