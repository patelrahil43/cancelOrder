<?php

/**
 * Copyright © 2015 Infobit . All rights reserved.
 */

namespace Infobit\CancelOrder\Block\Request;

use Infobit\CancelOrder\Block\BaseBlock;

class Cancellation extends BaseBlock {

    protected $order;

    public function __construct(
    \Infobit\CancelOrder\Block\Context $context,
    \Infobit\CancelOrder\Model\ResourceModel\Reason\Collection $reasonList,
     \Magento\Sales\Model\Order $order,
     array $data = []
    ) {
        $this->order = $order;
        $this->reasonList = $reasonList;
        parent::__construct($context, $data);
    }

    public function _prepareLayout() {
        return parent::_prepareLayout();
    }

    public function getOrder() {
        $orderId = (int) $this->getRequest()->getParam('order_id');
        $order = $this->order->load($orderId);

        return $order;
    }

    public function getBackUrl($order) {

        if ($order->getId() > 0) {
            return $this->getUrl('sales/order/view', ['order_id' => $order->getId()]);
        } else {
            return $this->getUrl('customer/account/');
        }
    }

    public function getFormUrl($order) {
        return $this->getUrl('cancelorder/request/post', ['order_id' => $order->getId()]);
    }

    public function getReasonList() {
        
        $reasonList = $this->reasonList;
        $reasonList->addFieldToFilter('status',1);
        
        $reasonArray = array();
        foreach($reasonList as $reason) {
            $reasonArray[$reason->getEntityId()] = $reason->getName();
        } 
        return $reasonArray;
    }
}
