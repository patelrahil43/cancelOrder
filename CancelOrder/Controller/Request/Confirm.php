<?php

/**
 *
 * Copyright © 2015 Infobitcommerce. All rights reserved.
 */

namespace Infobit\CancelOrder\Controller\Request;

class Confirm extends \Magento\Framework\App\Action\Action {

    /**
     * @var \Magento\Framework\App\Cache\TypeListInterface
     */
    protected $_cacheTypeList;

    /**
     * @var \Magento\Framework\App\Cache\StateInterface
     */
    protected $_cacheState;

    /**
     * @var \Magento\Framework\App\Cache\Frontend\Pool
     */
    protected $_cacheFrontendPool;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList
     * @param \Magento\Framework\App\Cache\StateInterface $cacheState
     * @param \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
    \Magento\Framework\App\Action\Context $context, \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList, \Magento\Framework\App\Cache\StateInterface $cacheState, \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Sales\Model\Order $order, \Infobit\CancelOrder\Model\Reason $reason, \Infobit\CancelOrder\Model\Request $requestModel, \Infobit\CancelOrder\Model\Item $itemModel
    ) {
        parent::__construct($context);
        $this->_cacheTypeList = $cacheTypeList;
        $this->_cacheState = $cacheState;
        $this->_cacheFrontendPool = $cacheFrontendPool;
        $this->resultPageFactory = $resultPageFactory;
        $this->order = $order;
        $this->reason = $reason;
        $this->request = $requestModel;
        $this->item = $itemModel;
    }

    /**
     * Flush cache storage
     *
     */
    public function execute() {

        $orderId = (int) $this->getRequest()->getParam('request_id');
        $data = $this->getRequest()->getParams();
        $resultRedirect = $this->resultRedirectFactory->create();

        $orderModel = $this->request->load($orderId);

        if ($orderModel->getRequestId() <= 0) {

            $this->messageManager->addError(__('Invalid Data Specified.'));
            die;
            //if order is not exists related logic
            return $resultRedirect->setPath('/customer/account/');
        }
        
        $this->_view->loadLayout();
        $this->_view->renderLayout();
               
    }

}
