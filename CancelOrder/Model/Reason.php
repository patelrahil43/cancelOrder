<?php

namespace Infobit\CancelOrder\Model;

class Reason extends \Magento\Framework\Model\AbstractModel
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    
    protected function _construct()
    {
        $this->_init('Infobit\CancelOrder\Model\ResourceModel\Reason');
    }
    
     /* Prepare reson's statuses.
     * Available event cms_page_get_available_statuses to customize statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
}