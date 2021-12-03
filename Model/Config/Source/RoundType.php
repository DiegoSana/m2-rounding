<?php
declare(strict_types=1);

namespace Sofar\Rounding\Model\Config\Source;

class RoundType implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => 'floor',
                'label' => __('Floor')
            ],
            [
                'value' => 'round',
                'label' => __('Round')
            ],
            [
                'value' => 'ceil',
                'label' => __('Ceil')
            ]
        ];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return ['floor' => __('Floor'), 'round' => __('Round'), 'ceil' => __('Ceil')];
    }
}
