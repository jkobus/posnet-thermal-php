<?php

namespace Posnet\Printer;

use Posnet\Printer\Adapter\AdapterInterface;

/**
 * Represents printable entity
 */
interface PrintableInterface
{
    /**
     * @param AdapterInterface $adapter
     * @return bool Return true if print succeeded
     */
    public function doPrint(AdapterInterface $adapter);
}