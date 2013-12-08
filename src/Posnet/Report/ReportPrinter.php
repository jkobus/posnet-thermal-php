<?php

namespace Posnet\Report;

use Posnet\Printer\PrintableInterface;
use Posnet\Printer\Adapter\AdapterInterface;

/**
 * Class ReportPrinter
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class ReportPrinter implements PrintableInterface
{
    /**
     * @var ReportInterface
     */
    protected $report;

    /**
     * @param ReportInterface $report
     */
    function __construct(ReportInterface $report)
    {
        $this->report = $report;
    }

    /**
     * @param ReportInterface $report
     */
    public function setReport($report)
    {
        $this->report = $report;
    }

    /**
     * @return ReportInterface
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * {@inheritdoc}
     */
    public function doPrint(AdapterInterface $adapter)
    {
        $report = $this->getReport();
        if($report instanceof DailyReport){
            $adapter->printDailyReport($report->getDate());
        }
    }
}