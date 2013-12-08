<?php

namespace Posnet\Printer\Adapter;

use Posnet\Printer\Connector\ConnectorInterface;

/**
 * Class AbstractAdapter
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
abstract class AbstractAdapter implements AdapterInterface
{
    /**
     * @var ConnectorInterface
     */
    protected $connector;

    /**
     * {@inheritdoc}
     */
    public function setConnector(ConnectorInterface $connector)
    {
        $this->connector = $connector;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getConnector()
    {
        return $this->connector;
    }
}