<?php

namespace Infobit\CancelOrder\Model\ResourceModel\Item;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {

    protected function _construct() {
        $this->_init(
                'Infobit\CancelOrder\Model\Item', 'Infobit\CancelOrder\Model\ResourceModel\Item'
        );
    }

}
