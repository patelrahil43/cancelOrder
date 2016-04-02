<?php

/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Infobit\CancelOrder\Controller\Adminhtml\Reason;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Filesystem\DirectoryList;

class Exportcsv extends \Infobit\CancelOrder\Controller\Adminhtml\Reason {

    /**
     * Export subscribers grid to CSV format
     *
     * @return ResponseInterface
     */
    public function execute() {
        $this->_view->loadLayout();
        $fileName = 'Reason.csv';
        $content = $this->_view->getLayout()->getChildBlock('adminhtml.cancelorder.reason.grid', 'grid.export');

//        print_r($content);
//        print_r($content->getCsvFile($fileName));
//        die;
        
        return $this->_fileFactory->create(
                        $fileName, $content->getCsvFile($fileName), DirectoryList::VAR_DIR
        );
    }

}
