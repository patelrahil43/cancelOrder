<?php

/**
 * Copyright © 2015 Infobit . All rights reserved.
 */

namespace Infobit\CancelOrder\Block\Request;

use Infobit\CancelOrder\Block\BaseBlock;

class Confirm extends BaseBlock {

    protected $order;

    public function __construct(
    \Infobit\CancelOrder\Block\Context $context,  \Infobit\CancelOrder\Model\ResourceModel\Item\Collection $itemCollection, \Infobit\CancelOrder\Model\Request $request, \Magento\Sales\Model\Order $order, array $data = []
    ) {
        $this->order = $order;
        $this->request = $request;
        $this->itemcollection = $itemCollection;
        parent::__construct($context, $data);
    }

    public function _prepareLayout() {
        return parent::_prepareLayout();
    }

    public function getOrder() {
        $requestId = (int) $this->getRequest()->getParam('request_id');
        
        $requestModel = $this->request->load($requestId);
        $this->request = $requestModel;
        if($requestModel->getOrderId() > 0) {
            
            $order = $this->order->load($requestModel->getOrderId());
            return $order;
        }  
    }

    public function getBackUrl($order) {

        if ($order->getId() > 0) {
            return $this->getUrl('sales/order/view', ['order_id' => $order->getId()]);
        } else {
            return $this->getUrl('customer/account/');
        }
    }

    
    public function getItemCollection(){
        
        
        $itemColl = $this->itemcollection;
        
        $itemColl->addFieldToFilter('request_id',array("eq"=>$this->request->getRequestId()));
        $itemArray = array();
        foreach($itemColl as $item) {
            $itemArray[$item->getItemId()] = $item->getQty();
        }
        
        return $itemArray;
        
    }

}
