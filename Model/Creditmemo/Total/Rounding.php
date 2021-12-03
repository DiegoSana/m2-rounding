<?php
declare(strict_types=1);

namespace Sofar\Rounding\Model\Creditmemo\Total;

use Magento\Sales\Model\Order\Creditmemo;

class Rounding extends \Magento\Sales\Model\Order\Total\AbstractTotal
{

    /**
     * @var string
     */
    protected $_code = 'grand_total_rounding';

    /**
     * @param Creditmemo $creditmemo
     * @return $this
     */
    public function collect(Creditmemo $creditmemo)
    {

        $creditmemo->setGrandTotalRounding(0);
        $creditmemo->setBaseGrandTotalRounding(0);
        $amount = $creditmemo->getOrder()->getGrandTotalRounding();
        $creditmemo->setGrandTotalRounding((float)$amount);
        $amount = $creditmemo->getOrder()->getBaseGrandTotalRounding();
        $creditmemo->setBaseGrandTotalRounding((float)$amount);
        $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $creditmemo->getGrandTotalRounding());
        $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $creditmemo->getGrandTotalRounding());

        return $this;
    }
}
