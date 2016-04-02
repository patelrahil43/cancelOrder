<?php

/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
/**
 * Order Statuses source model
 */

namespace Infobit\CancelOrder\Model\Config\Source\Order;

class UnassignedStatus implements \Magento\Framework\Option\ArrayInterface {

    const UNDEFINED_OPTION_LABEL = '-- Please Select --';

    /**
     * @var string[]
     */
    protected $_stateStatuses = [
        \Magento\Sales\Model\Order::STATE_NEW,
        \Magento\Sales\Model\Order::STATE_PROCESSING,
        \Magento\Sales\Model\Order::STATE_COMPLETE,
        \Magento\Sales\Model\Order::STATE_CLOSED,
        \Magento\Sales\Model\Order::STATE_CANCELED,
        \Magento\Sales\Model\Order::STATE_HOLDED,
    ];

    /**
     * @var \Magento\Sales\Model\Order\Config
     */
    protected $_orderConfig;

    /**
     * @param \Magento\Sales\Model\Order\Config $orderConfig
     */
    public function __construct(\Magento\Sales\Model\Order\Config $orderConfig, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig) {
        $this->_orderConfig = $orderConfig;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return array
     */
    public function toOptionArray() {
        $statuses = $this->_stateStatuses ? $this->_orderConfig->getStatuses() : $this->_orderConfig->getStatuses();

        $options = [['value' => '', 'label' => __(self::UNDEFINED_OPTION_LABEL)]];
        foreach ($statuses as $code => $label) {
            $options[] = ['value' => $code, 'label' => $label];
        }
        return $options;
    }

   

}
