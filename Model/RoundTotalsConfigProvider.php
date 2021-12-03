<?php
declare(strict_types=1);

namespace Sofar\Rounding\Model;

use Sofar\Rounding\Helper\Data;
use Magento\Checkout\Model\ConfigProviderInterface;

class RoundTotalsConfigProvider implements ConfigProviderInterface
{

    /**
     * @var Data
     */
    protected $_helper;

    /**
     * RoundTotalsConfigProvider constructor.
     * @param Data $helper
     */
    public function __construct(Data $helper)
    {
        $this->_helper = $helper;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        $config = [
            'sofar_rounding' => [
                'enabled' => $this->_helper->getEnabled(),
                'label' => $this->_helper->getLabel()
            ]
        ];

        return $config;
    }
}
