<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Infobit\CancelOrder\Block\Request;

/**
 * Description of Items
 *
 * @author dell
 */
class Items extends \Magento\Framework\View\Element\Template {

    //put your code here

    protected $order;

    public function __construct(
    \Magento\Backend\Block\Template\Context $context, 
    \Magento\Framework\Registry $registry,
    \Magento\Framework\App\Http\Context $httpContext,
    array $data = []
    ) {
        //$this->order = $order;
        $this->_coreRegistry = $registry;
        $this->httpContext = $httpContext;
        parent::__construct($context, $data);
    }

    public function _prepareLayout() {
        return parent::_prepareLayout();
    }

     /**
     * Retrieve current order model instance
     *
     * @return \Magento\Sales\Model\Order
     */
    public function getOrder()
    {
        
        if(!$this->_coreRegistry->registry('current_order')) {
            $orderId = (int)$this->getRequest()->getParam('order');
            
        }
        
        return $this->_coreRegistry->registry('current_order');
    }
    
    
    public function getOrderItems() {
        
        
        
        //$order = $this->order->load();
        
        $order = $this->getOrder();

        return $order->getVisibleItems();
    }

}
