<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Infobit\CancelOrder\Controller\Adminhtml\Request;

class Index extends \Infobit\CancelOrder\Controller\Adminhtml\Request
{
    /**
     * Newsletter subscribers page
     *
     * @return void
     */
    public function execute()
    {
        if ($this->getRequest()->getParam('ajax')) {
            $this->_forward('grid');
            return;
        }

        $this->_view->loadLayout();

        $this->_setActiveMenu('Infobit_CancelOrder::cancelorder');
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Cancel Order Request manager'));

        $this->_addBreadcrumb(__('CancelOrder'), __('Reasons'));
        $this->_addBreadcrumb(__('CancelOrder'), __('Reasons'));

        $this->_view->renderLayout();
    }
}
