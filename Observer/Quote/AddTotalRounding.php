<?php
declare(strict_types=1);

namespace Sofar\Rounding\Observer\Quote;

use Magento\Framework\Event\ObserverInterface;

class AddTotalRounding implements ObserverInterface
{

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $quote = $observer->getQuote();
        $total = $observer->getTotal();

        if ($total->getGrandTotal()) {
            $quote->setGrandTotalRounding($total->getGrandTotalRounding());
            $quote->setBaseGrandTotalRounding($total->getBaseGrandTotalRounding());
        }
    }
}
