<?php

namespace Posnet;

use Posnet\Adapter\AdapterInterface;

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