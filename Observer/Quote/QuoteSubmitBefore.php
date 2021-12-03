<?php
declare(strict_types=1);

namespace Sofar\Rounding\Observer\Quote;

use Magento\Framework\Event\ObserverInterface;

class QuoteSubmitBefore implements ObserverInterface
{

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $quote = $observer->getQuote();
        $order = $observer->getOrder();

        $order->setGrandTotalRounding($quote->getGrandTotalRounding());
        $order->setBaseGrandTotalRounding($quote->getBaseGrandTotalRounding());
    }
}
