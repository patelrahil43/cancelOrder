<?php

/**
 *
 * Copyright © 2015 Infobitcommerce. All rights reserved.
 */

namespace Infobit\CancelOrder\Controller\Request;

class Post extends \Magento\Framework\App\Action\Action {

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
            ,  \Infobit\CancelOrder\Model\Config $config
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
        $this->config = $config;
    }

    /**
     * Flush cache storage
     *
     */
    public function execute() {

        
       
        $orderId = (int) $this->getRequest()->getParam('order_id');
        $data = $this->getRequest()->getParams();
        $resultRedirect = $this->resultRedirectFactory->create();

        $orderModel = $this->order->load($orderId);

        if ($orderModel->getId() <= 0) {

            $this->messageManager->addError(__('Wrong Order Specified.'));
            //if order is not exists related logic
            return $resultRedirect->setPath('/customer/account/');
        }
        //current order model
        $this->order = $orderModel;


//        if ($orderModel->getCustomerId()) {
//            //if customer id is not mathcing relatd logic
//            $this->messageManager->addError(__('Wrong Customer Id.'));
//            $resultRedirect->setPath('/account/customer/');
//            return $resultRedirect;
//        }

        if ($this->validateData() == false) {
            
            return $resultRedirect->setPath('/customer/account/');
        }

        //save logic start from here
        $itemCount = count($data['item']);
        $requestedData = array();
        $requestedData['item_count'] = $itemCount;
        $requestedData['order_id'] = $data['order_id'];
        $requestedData['reason_name'] = $this->reason->getName();
        $requestedData['comment'] = $data['comment'];
        $requestedData['status'] = $this->request->getInitialStatus();
        
        
        $itemData = array();
               
        try {
            $request = $this->request->setData($requestedData)->save();
            $itemModel = $this->item;
            
            foreach($data['item'] as $itemId=>$cancelItem) {
                
                //canceled item data
                $itemDataTemp = array();
                $itemDataTemp['item_id'] = $itemId;
                $itemDataTemp['request_id'] = $request->getData('request_id');
                $itemDataTemp['order_id'] = $orderId;
                $itemDataTemp['qty'] = $cancelItem['qty'];
                
                $item = $this->item->setData($itemDataTemp)->save();
            }
            
//            $path = \Infobit\CancelOrder\Model\Constant::PATH_INFOBIT_CANCELORDER_DEFAULT_STATUS;
//            $initialStatus = $this->config->getCurrentStoreConfigValue($path);         
//            $orderModel->setStatus($initialStatus);
//            $orderModel->getResource()->saveAttribute($orderModel,'status');
            
          //  $request->sendOrderCancellationMail();
            
                        
        } catch(Exception $e) {
            
            $this->messageManager->addError(__('Error while proccessing Order Cancellation. Please try again after some time.'));
            return $resultRedirect->setPath('*/*/cancellation',['order_id' => $orderId]);
            
            
        }

//        print "<pre>";
//        print_r($data);
//        print "</pre>";
//
//        die;
        return $resultRedirect->setPath('*/*/confirm',['request_id' => $request->getRequestId()]);
            
    }

    public function validateData() {

        $orderId = (int) $this->getRequest()->getParam('order_id');
        $data = $this->getRequest()->getParams();

        $requestedCancelItems = $data['item'];

        if (count($requestedCancelItems) == 0) {

            $this->messageManager->addError(__('No Item has been specified.'));
            return false;
        }
        $items = $this->order->getAllItems();
        $itemCount = 0;
        foreach ($items as $item) {

            if (!empty($requestedCancelItems[$item->getItemId()])) {

                if ($requestedCancelItems[$item->getItemId()]['qty'] == 0 || $requestedCancelItems[$item->getItemId()]['qty'] > $item->getQtyOrdered()) {
                    $this->messageManager->addError(__('Invalid qty specified for Item %s', $item->getName()));
                    return false;
                }
                $itemCount++;
            }
        }
        if ($itemCount == 0) {
            $this->messageManager->addError(__('Invalid Item specified'));
            return false;
        }


        //validation for the reason id and comment
        if (empty($data['reason'])) {
            $this->messageManager->addError(__('Invalid Reason specified'));
            return false;
        } else {

            $reasonModel = $this->reason->load($data['reason']);
            $this->reason = $reasonModel;
            if ($reasonModel === false || $reasonModel->getStatus() == 0) {
                $this->messageManager->addError(__('Invalid Reason specified'));
                return false;
            }
        }

        //validation of comment field
        if (empty($data['comment'])) {
            $this->messageManager->addError(__('Comment is Required Field'));
            return false;
        }

        return true;
    }

}
