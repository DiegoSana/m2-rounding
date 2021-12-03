<?php
declare(strict_types=1);

namespace Sofar\Rounding\Block\Adminhtml\Creditmemo\Totals;

class Rounding extends \Magento\Framework\View\Element\Template
{

    public function initTotals()
    {
        /** @var \Magento\Sales\Block\Order\Totals $parent */
        $parent = $this->getParentBlock();
        $source = $parent->getSource();

        #Invoice + Creditmemo
        $grandTotalRounding = $source->getOrder()->getGrandTotalRounding();
        $baseGrandTotalRounding = $source->getOrder()->getBaseGrandTotalRounding();

        if ($grandTotalRounding != null) {
            $total = new \Magento\Framework\DataObject([
                'code' => 'grand_total_rounding',
                'value' => $grandTotalRounding,
                'base_value' => $baseGrandTotalRounding,
                'label' => __('Rounding')
            ]);
            $parent->addTotal($total, 'tax');
        }
    }
}
