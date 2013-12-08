<?php

namespace Posnet\Report;
use DateTime;

/**
 * Class DailyReport
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class PeriodicReport implements ReportInterface
{
    /**
     * @var DateTime
     */
    protected $dateStart;

    /**
     * @var DateTime
     */
    protected $dateEnd;

    /**
     * @param DateTime $dateStart
     * @param DateTime $dateEnd
     */
    function __construct(DateTime $dateStart, DateTime $dateEnd)
    {
        if(!$dateStart){
            $dateStart = new DateTime();
        }

        if(!$dateEnd){
            $dateEnd = new DateTime();
        }

        $this->setDateStart($dateStart);
        $this->setDateEnd($dateEnd);
    }

    /**
     * @param \DateTime $dateEnd
     */
    public function setDateEnd(DateTime $dateEnd)
    {
        $this->dateEnd = $dateEnd;
    }

    /**
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @param \DateTime $dateStart
     */
    public function setDateStart(DateTime $dateStart)
    {
        $this->dateStart = $dateStart;
    }

    /**
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }
}