<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Newsletter queue grid block action item renderer
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */

namespace Infobit\CancelOrder\Block\Adminhtml\Reason\Grid\Renderer;

class Action extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\Action
{
    /**
     * Renders column
     *
     * @param \Magento\Framework\DataObject $row
     * @return string
     */
    public function render(\Magento\Framework\DataObject $row)
    {
        $actions = [];
        $url = $this->getUrl('*/*/edit', ['entity_id' => $row->getEntityId()]);
        return "<a class='action-menu-item'  href='$url'>View</a>";
        
        $this->getColumn()->setActions($actions);
        return parent::render($row);
    }
   
}
