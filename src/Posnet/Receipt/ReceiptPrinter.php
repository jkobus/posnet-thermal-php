<?php

namespace Posnet\Receipt;

use Posnet\Printer\PrintableInterface;
use Posnet\Printer\Adapter\AdapterInterface;

/**
 * Class ReceiptPrinter
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class ReceiptPrinter implements PrintableInterface
{
    /**
     * @var Receipt
     */
    protected $receipt;

    /**
     * @param Receipt $receipt
     */
    function __construct(Receipt $receipt)
    {
        $this->receipt = $receipt;
    }

    /**
     * @param AdapterInterface $adapter
     * @return $this
     */
    public function doPrint(AdapterInterface $adapter)
    {
    }
}