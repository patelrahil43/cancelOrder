<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Infobit\CancelOrder\Controller\Adminhtml\Reason;

class MassDisable extends \Infobit\CancelOrder\Controller\Adminhtml\Reason
{
    /**
     * Unsubscribe one or more reasons action
     *
     * @return void
     */
    public function execute()
    {
        $reasonsIds = $this->getRequest()->getParam('entity_ids');
        if (!is_array($reasonsIds)) {
            $this->messageManager->addError(__('Please select one or more reasons.'));
        } else {
            try {
                foreach ($reasonsIds as $reasonId) {
                    $reason = $this->_objectManager->create(
                        'Infobit\CancelOrder\Model\Reason'
                    )->load(
                        $reasonId
                    );
                    $reason->setStatus(\Infobit\CancelOrder\Model\Reason::STATUS_DISABLED)->save();
                }
                $this->messageManager->addSuccess(__('A total of %1 record(s) were updated.', count($reasonsIds)));
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }
}
