<?php

/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Infobit\CancelOrder\Controller\Adminhtml;

/**
 * Newsletter subscribers controller
 */
abstract class Reason extends \Magento\Backend\App\Action {

    /**
     * @var \Magento\Framework\App\Response\Http\FileFactory
     */
    protected $_fileFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Response\Http\FileFactory $fileFactory
     */
    public function __construct(
    \Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry, \Magento\Framework\App\Response\Http\FileFactory $fileFactory
    ) {
        $this->_coreRegistry = $coreRegistry;
        $this->_fileFactory = $fileFactory;
        parent::__construct($context);
    }

    /**
     * Check if user has enough privileges
     *
     * @return bool
     */
    protected function _isAllowed() {
        return true;
    }

}
