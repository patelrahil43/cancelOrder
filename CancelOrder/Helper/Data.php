<?php

/**
 * Copyright © 2015 Infobit . All rights reserved.
 */

namespace Infobit\CancelOrder\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper {

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(\Magento\Framework\App\Helper\Context $context
    ) {
        parent::__construct($context);
    }

    public function getConfig($config_path) {
        return $this->scopeConfig->getValue(
                        $config_path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

}
