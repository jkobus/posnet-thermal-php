<?php

namespace Posnet\Receipt;

/**
 * Class ReceiptItem
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class ReceiptItem
{
    protected $name;
    protected $tax;
    protected $netPrice;
    protected $grossPrice;
    protected $quantity;

    function __construct($name, $netPrice, $quantity, $tax)
    {
        $this->name = $name;
        $this->netPrice = $netPrice;
        $this->quantity = $quantity;
        $this->tax = $tax;
    }

}