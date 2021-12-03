<?php
declare(strict_types=1);

namespace Sofar\Rounding\Block\Sales\Order;

use Sofar\Rounding\Helper\Data;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Element\AbstractBlock;

class Totals extends AbstractBlock
{
    /**
     * @var Data
     */
    protected $helper;

    /**
     * Totals constructor.
     * @param Context $context
     * @param Data $helper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Data $helper,
        array $data = []
    ) {
        $this->helper = $helper;
        parent::__construct($context, $data);
    }

    /**
     * @return $this
     */
    public function initTotals()
    {
        $orderTotalsBlock = $this->getParentBlock();
        $order = $orderTotalsBlock->getOrder();
        if (abs(floatval($order->getGrandTotalRounding())) > 0) {

            $totals = $this->getParentBlock()->getTotals();

            $total = new \Magento\Framework\DataObject(
                [
                    'code' => $this->getNameInLayout(),
                    'label' => __($this->helper->getLabel()),
                    'value'      => $order->getGrandTotalRounding(),
                    'base_value' => $order->getBaseGrandTotalRounding(),
                ]
            );

            if (isset($totals['grand_total_incl'])) {
                $this->getParentBlock()->addTotalBefore($total, 'grand_total');
            } else {
                $this->getParentBlock()->addTotalBefore($total, $this->getBeforeCondition());
            }
        }
        return $this;
    }
}