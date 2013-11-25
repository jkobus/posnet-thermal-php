<?php

namespace Posnet\Printer\Adapter;

use Posnet\Printer\Transport\TransportAwareInterface;

/**
 * Crafts packets so the printer can read them
 */
interface AdapterInterface extends TransportAwareInterface
{
//    /**
//     * Tell if current adapter has a transport
//     *
//     * @return bool
//     */
//    public function hasTransport();

    public function isOnline();

    public function isReady();

    public function isBusy();

    public function isInFiscalMode();

    public function isInTestMode();
}