<?php
declare(strict_types=1);

namespace Sofar\Rounding\Model\Quote\Address\Total;

use Sofar\Rounding\Helper\Data;
use Magento\Quote\Model\Quote\Address\Total;
use Magento\Quote\Api\Data\ShippingAssignmentInterface;
use Magento\Quote\Model\Quote;
use Magento\Quote\Model\Quote\Address\Total\AbstractTotal;

class Rounding extends AbstractTotal
{

    /**
     * @var string
     */
    protected $_code = 'grand_total_rounding';

    /**
     * @var Data
     */
    protected $_helper;

    /**
     * Rounding constructor.
     * @param Data $helper
     */
    public function __construct(Data $helper)
    {
        $this->_helper = $helper;
    }

    /**
     * Collect totals process.
     *
     * @param Quote $quote
     * @param ShippingAssignmentInterface $shippingAssignment
     * @param Total $total
     * @return $this|Total\AbstractTotal
     */
    public function collect(
        Quote $quote,
        ShippingAssignmentInterface $shippingAssignment,
        Total $total
    ) {
        if (!$this->_helper->getEnabled()) {
            return $this;
        }

        parent::collect($quote, $shippingAssignment, $total);

        $total->setTotalAmount($this->getCode(), 0);
        $total->setBaseGrandTotalAmount($this->getCode(), 0);

        $grandTotal = $total->getGrandTotal();
        $floorTotal = $this->round($grandTotal);

        if (abs($floorTotal - $grandTotal) > 0.001) {
            $baseRoundTotal = $this->round($total->getBaseGrandTotal());
            $grandTotalRounding = $floorTotal - $grandTotal;
            $baseGrandTotalRounding = $baseRoundTotal - $total->getBaseGrandTotal();

            $total->addTotalAmount($this->getCode(), $grandTotalRounding);
            $total->addBaseTotalAmount($this->getCode(), $baseGrandTotalRounding);
            $total->setGrandTotalRounding($grandTotalRounding);
            $total->setBaseGrandTotalRounding($baseGrandTotalRounding);
            $total->setGrandTotal($total->getGrandTotal() + $grandTotalRounding);
            $total->setBaseGrandTotal($total->getBaseGrandTotal() + $baseGrandTotalRounding);
        }

        return $this;
    }

    /**
     * Fetch (Retrieve data as array)
     *
     * @param Quote $quote
     * @param Total $total
     * @return array
     */
    public function fetch(Quote $quote, Total $total)
    {
        return [
            'code' => $this->getCode(),
            'title' => $this->getLabel(),
            'value' => $total->getGrandTotalRounding()
        ];
    }

    /**
     * Get Shipping label
     *
     * @return \Magento\Framework\Phrase
     */
    public function getLabel()
    {
        return __('Rounding');
    }

    /**
     * @param $value
     * @return float
     */
    private function round($value)
    {
        $roundType = $this->_helper->getRoundType();

        switch ($roundType) {
            case "floor":
                return floor($value);
            case "round":
                return round($value);
            case "ceil":
                return ceil($value);
            default:
                return round($value);
        }
    }
}
