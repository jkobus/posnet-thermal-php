<?php

namespace Posnet\Printer;

use Posnet\Printer\Adapter\AdapterInterface;
use Posnet\Printer\Connector\ConnectorInterface;

/**
 * Class Printer
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class Printer implements PrinterInterface
{
    /**
     * @var ConnectorInterface
     */
    protected $connector;

    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @param AdapterInterface $adapter
     * @param ConnectorInterface $connector
     */
    function __construct(AdapterInterface $adapter = null, ConnectorInterface $connector = null)
    {
        if($adapter){
            $this->setAdapter($adapter);
        }
        if($connector){
            $this->setConnector($connector);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setAdapter(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        if($this->getConnector() !== null){
            $adapter->setConnector($this->getConnector());
        }
        return $this;
    }

    /**
     * @return AdapterInterface
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * {@inheritdoc}
     */
    public function setConnector(ConnectorInterface $connector)
    {
        $this->connector = $connector;
        if($this->getAdapter() !== null){
            $this->getAdapter()->setConnector($connector);
        }
        return $this;
    }

    /**
     * @return ConnectorInterface
     */
    public function getConnector()
    {
        return $this->connector;
    }


    /**
     * {@inheritdoc}
     */
    public function isOnline()
    {
        // @todo Implement isOnline() method.
    }

    /**
     * {@inheritdoc}
     */
    public function isBusy()
    {
        // @todo Implement isBusy() method.
    }

    /**
     * Print
     *
     * @param PrintableInterface $printable
     * @return bool
     */
    public function doPrint(PrintableInterface $printable)
    {
        $isSuccessful = $printable->doPrint($this->getAdapter());
        return (bool)$isSuccessful;
    }
}