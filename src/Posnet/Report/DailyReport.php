<?php

namespace Posnet\Report;
use DateTime;

/**
 * Class DailyReport
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class DailyReport extends PeriodicReport implements ReportInterface
{
    /**
     * @param DateTime $date Defaults to "today"
     */
    function __construct(DateTime $date = null)
    {
        if($date === null){
            $date = new DateTime();
        }
        $this->setDate($date);
    }

    /**
     * @param \DateTime $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->setDateStart($date);
        $this->setDateEnd($date);
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->getDateStart();
    }
}