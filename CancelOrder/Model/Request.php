<?php

namespace Infobit\CancelOrder\Model;

class Request extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Infobit\CancelOrder\Model\ResourceModel\Request');
    }
    
    public function getInitialStatus() {
        
        
        $status = \Infobit\CancelOrder\Model\Constant::CANCELORDER_SUCESS_STATUS;
        return $status;
        
    }
//    
//    public function changeOrderStatus($order) {
//        
//        //change order status
//        $model = $this->_objectManager->create('Full\Model\Class\Name\Here');
//        
//    }
    
    public function sendEmail($param) {
        
    }
    
}