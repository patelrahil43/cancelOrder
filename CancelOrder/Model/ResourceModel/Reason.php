<?php

namespace Infobit\CancelOrder\Model\ResourceModel;

class Reason extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('infobit_cancelorder_reason', 'entity_id');
    }
}