<?php

namespace Infobit\CancelOrder\Model;

class Item extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Infobit\CancelOrder\Model\ResourceModel\Item');
    }
}