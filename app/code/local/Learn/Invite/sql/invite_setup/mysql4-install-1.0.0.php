<?php
$installer = $this;
$installer->startSetup();
$table = $installer->getConnection()
    ->newTable($installer->getTable('invite/invite'))
    ->addColumn('invite_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Id')		
    ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        ), 'Customer Id')
    ->addColumn('friend_name', Varien_Db_Ddl_Table::TYPE_TEXT, 100, array(
        ), 'Friend Name')
    ->addColumn('friend_email', Varien_Db_Ddl_Table::TYPE_TEXT, 100, array(
        ), 'Friend Email')
    ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        ), 'Store Id')			
   ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'nullable'  => false,
        ), 'Created At')
	
    ->setComment('Invite Friend');	
$installer->getConnection()->createTable($table);
$installer->endSetup();
?>