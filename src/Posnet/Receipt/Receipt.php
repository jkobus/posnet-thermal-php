<?php

namespace Posnet\Receipt;

/**
 * Class Receipt
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class Receipt
{
    /**
     * @var array|ReceiptItem[]
     */
    protected $items;

    /**
     * @param ReceiptItem $item
     * @return $this
     */
    public function addItem(ReceiptItem $item)
    {
        $this->items[] = $item;
        return $this;
    }
}