<?php

namespace Posnet\Receipt;

use Posnet\Adapter\AdapterInterface;
use Printer\Mapper\MapperInterface;

class ReceiptMapper implements MapperInterface
{
    /**
     * @param AdapterInterface $adapter
     * @return $this
     */
    public function doPrint(AdapterInterface $adapter)
    {
        // TODO: Implement doPrint() method.
    }
}