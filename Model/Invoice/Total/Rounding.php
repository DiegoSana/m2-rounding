<?php
declare(strict_types=1);

namespace Sofar\Rounding\Model\Invoice\Total;

use Magento\Sales\Model\Order\Invoice;

class Rounding extends \Magento\Sales\Model\Order\Total\AbstractTotal
{

    /**
     * @var string
     */
    protected $_code = 'grand_total_rounding';

    /**
     * @param Invoice $invoice
     * @return $this
     */
    public function collect(Invoice $invoice)
    {

        $invoice->setGrandTotalRounding(0);
        $invoice->setBaseGrandTotalRounding(0);
        $amount = $invoice->getOrder()->getGrandTotalRounding();
        $invoice->setGrandTotalRounding((float)$amount);
        $amount = $invoice->getOrder()->getBaseGrandTotalRounding();
        $invoice->setBaseGrandTotalRounding((float)$amount);
        $invoice->setGrandTotal($invoice->getGrandTotal() + $invoice->getGrandTotalRounding());
        $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $invoice->getGrandTotalRounding());

        return $this;
    }
}
