<?php

namespace Infobit\CancelOrder\Model\ResourceModel\Request;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {

    protected function _construct() {
        $this->_init(
                'Infobit\CancelOrder\Model\Request', 'Infobit\CancelOrder\ResourceModel\Request'
        );
    }

}
