<?php


namespace Infobit\CancelOrder\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface {

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {


        $setup->startSetup();
        $table = $setup->getConnection()
                ->newTable($setup->getTable('infobit_cancelorder_reason'))
                ->addColumn(
                        'entity_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'Entity ID'
                )
                ->addColumn(
                        'name', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 64, [], 'Name'
                )
                ->addColumn(
                        'status', \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN, null, [], 'Status'
                )
                ->setComment('CancelOrder Request Questions');
        $setup->getConnection()->createTable($table);

        $table = $setup->getConnection()
                ->newTable($setup->getTable('infobit_cancelorder_request'))
                ->addColumn(
                        'request_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'Entity ID'
                )
                ->addColumn(
                        'order_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['unsigned' => true, 'nullable' => false], 'Order Id'
                )
                ->addColumn(
                        'item_count', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['unsigned' => true, 'nullable' => false], 'Item Count'
                )
                ->addColumn(
                        'reason_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['unsigned' => true, 'nullable' => false], 'Item Count'
                )
                ->addColumn(
                        'comment', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, null, [], 'Comment'
                )
                ->addColumn(
                        'status', \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT, null, ['unsigned' => true, 'nullable' => false], 'Item Count'
                )
                ->addColumn(
                        'created_at', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 64, [], 'Created AT'
                )
                ->addForeignKey(
                        $setup->getFkName('infobit_cancelorder_request', 'order_id', 'sales_order', 'entity_id'), 'order_id', $setup->getTable('sales_order'), 'entity_id', \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->addForeignKey(
                        $setup->getFkName('infobit_cancelorder_request', 'reason_id', 'infobit_cancelorder_reason', 'entity_id'), 'reason_id', $setup->getTable('infobit_cancelorder_reason'), 'entity_id', \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->setComment('Cancel Order Request Table');
        $setup->getConnection()->createTable($table);

        $table = $setup->getConnection()
                ->newTable($setup->getTable('infobit_cancelorder_item'))
                ->addColumn(
                        'entity_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['identity' => true,'unsigned' => true, 'nullable' => false, 'primary' => true], 'Item ID'
                )
                ->addColumn(
                        'item_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 10, ['unsigned' => true, 'nullable' => false], 'Item ID'
                )
                ->addColumn(
                        'request_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['unsigned' => true, 'nullable' => false, 'default' => '0'], 'Request ID'
                )
                ->addColumn(
                        'order_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['unsigned' => true, 'nullable' => false, 'default' => '0'], 'Order ID'
                )
                ->addColumn(
                        'item_name', \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT, null, ['unsigned' => true, 'nullable' => false, 'default' => '0'], 'Item Name'
                )
                ->addColumn(
                        'qty', \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT, null, ['unsigned' => true, 'nullable' => false, 'default' => '0'], 'Qty'
                )
                ->addColumn(
                        'price', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['unsigned' => true, 'nullable' => false, 'default' => '0'], 'Price'
                )
                ->addForeignKey(
                        $setup->getFkName('infobit_cancelorder_item', 'order_id', 'infobit_cancelorder_request', 'order_id'), 'order_id', $setup->getTable('infobit_cancelorder_request'), 'order_id', \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->addForeignKey(
                        $setup->getFkName('infobit_cancelorder_item', 'request_id', 'infobit_cancelorder_request', 'request_id'), 'request_id', $setup->getTable('infobit_cancelorder_request'), 'request_id', \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->addForeignKey(
                        $setup->getFkName('infobit_cancelorder_item', 'item_id', 'sales_order_item', 'item_id'), 'item_id', $setup->getTable('sales_order_item'), 'item_id', \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->setComment('Cancel Order Request Item');
        $setup->getConnection()->createTable($table);
        $setup->endSetup();
    }

}
