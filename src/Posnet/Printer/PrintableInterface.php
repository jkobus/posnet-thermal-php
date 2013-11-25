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
     * @return $this
     */
    public function doPrint(AdapterInterface $adapter);
}