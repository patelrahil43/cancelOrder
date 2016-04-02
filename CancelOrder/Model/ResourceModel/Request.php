<?php

namespace Infobit\CancelOrder\Model\ResourceModel;

class Request extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    
    const CANCELLATION_REQUEST_CONFIRMED = 1;
    const CANCELLATION_REQUEST_FAILED = 0;
    


    protected function _construct()
    {
        $this->_init('infobit_cancelorder_request', 'request_id');
    }
    
    
    
    public function getInitialRequestStatus() {
        
        return self::CANCELLATION_REQUEST_CONFIRMED;
    }
}