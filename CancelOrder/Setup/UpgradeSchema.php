<?php

namespace Infobit\CancelOrder\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface {

    /**
     * 
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context) {

        $setup->startSetup();
        if (version_compare($context->getVersion(), '1.0.0') <= 0) {

            $this->removeReasonId($setup);
            $this->addReasonName($setup);
            $this->addCeationDate($setup);
        }
        $setup->endSetup();
    }

    /**
     * Name: removeReasonId
     * Function: This function name is used to add the remove Reason iD
     * @param type $setup
     */
    public function removeReasonId($setup) {

        $connection = $setup->getConnection();
        $fields = [
            ['table' => 'infobit_cancelorder_request', 'column' => 'question_id']
        ];

        foreach ($fields as $filedInfo) {
            $connection->dropColumn($setup->getTable($filedInfo['table']), $filedInfo['column']);
        }
    }

    /**
     * Name: addReasonName
     * @param type $setup
     */
    public function addReasonName($setup) {

        $setup->getConnection()->addColumn(
                $setup->getTable('infobit_cancelorder_request'), 'reason_name', [
            'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            'length' => 1024,
            'nullable' => false,
            'comment' => 'Reason Name'
                ]
        );
    }

    public function addCeationDate($setup) {

        $setup->getConnection()->addColumn(
                        $setup->getTable('infobit_cancelorder_request'), 'created_at', [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    'nullable' => false,
                    'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT,
                    'comment' => 'Created At'
                        ]
                );
        
        $setup->getConnection()->addColumn(
                        $setup->getTable('infobit_cancelorder_request'), 'updated_at', [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    'nullable' => false,
                    'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE,
                    'comment' => 'Updated At'
                        ]
        );
    }

}
