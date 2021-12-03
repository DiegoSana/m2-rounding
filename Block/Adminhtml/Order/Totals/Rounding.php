<?php
declare(strict_types=1);

namespace Sofar\Rounding\Block\Adminhtml\Order\Totals;

use Magento\Framework\View\Element\Template;
use Sofar\Rounding\Helper\Data;

class Rounding extends Template
{

    /**
     * @var Data
     */
    protected $helper;

    public function __construct(
        Template\Context $context,
        Data $helper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->helper = $helper;
    }

    public function initTotals()
    {
        /** @var \Magento\Sales\Block\Order\Totals $parent */
        $parent = $this->getParentBlock();
        $source = $parent->getSource();

        #Order
        $grandTotalRounding = $source->getGrandTotalRounding();
        $baseGrandTotalRounding = $source->getBaseGrandTotalRounding();

        if ($grandTotalRounding != null) {
            $total = new \Magento\Framework\DataObject([
                'code' => 'grand_total_rounding',
                'value' => $grandTotalRounding,
                'base_value' => $baseGrandTotalRounding,
                'label' => __($this->helper->getLabel())
            ]);
            $parent->addTotal($total, 'tax');
        }
    }
}
