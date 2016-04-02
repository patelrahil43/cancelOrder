<?php

namespace Infobit\CancelOrder\Model\ResourceModel;

class Item extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('infobit_cancelorder_item', 'entity_id');
    }
}