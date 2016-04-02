<?php

namespace Infobit\CancelOrder\Model\ResourceModel\Reason;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {

    protected function _construct() {
        $this->_init(
                'Infobit\CancelOrder\Model\Reason', 'Infobit\CancelOrder\Model\ResourceModel\Reason'
        );
    }

}
