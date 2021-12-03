<?php
declare(strict_types=1);

namespace Sofar\Rounding\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{

    /**
     * @return mixed
     */
    public function getRoundType()
    {
        return $this->scopeConfig->getValue('sofar_rounding/general/round_type');
    }

    /**
     * @return bool
     */
    public function getEnabled()
    {
        return (bool)$this->scopeConfig->getValue('sofar_rounding/general/enabled');
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->scopeConfig->getValue('sofar_rounding/general/label');
    }
}
