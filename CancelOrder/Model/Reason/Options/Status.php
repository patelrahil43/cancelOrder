<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Infobit\CancelOrder\Model\Reason\Options;

/**
 * Description of Status
 *
 * @author dell
 */
class Status implements \Magento\Framework\Option\ArrayInterface {

    /**
     * Return statuses option array
     *
     * @return array
     */
    public function toOptionArray() {
        return [
            
        \Infobit\CancelOrder\Model\Reason::STATUS_ENABLED  => __('Enabled'),
        \Infobit\CancelOrder\Model\Reason::STATUS_DISABLED => __('Disabled')
        ];
    }

}
