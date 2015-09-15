<?php
class Learn_Invite_Block_Invite extends Mage_Core_Block_Template
{ 

	public function getuser()
	{
		$user = Mage::getSingleton('customer/session')->getCustomerId();
		return $user;
	}
	

   	public function getTotalOrder($prodid) 
	{
		/* $prodid = Mage::registry('current_product')->getId(); */
		$ret = 0;
		if($prodid) {
			$collection = Mage::getModel('sales/order')->getCollection();
			$collection->addAttributeToSelect('increment_id');
			$collection->addAttributeToSelect('grand_total' );
			$collection->addAttributeToSelect('status');
			$collection->getSelect()->join(array('sub' => $collection->getTable('sales/order_item')),'main_table.entity_id = sub.order_id', array('product_id' => 'product_id', 'qty_canceled' =>'qty_canceled', 'qty_refunded'=>'qty_refunded', 'qty_ordered' => 'qty_ordered'));		
			$collection->getSelect()->columns(' CAST(SUM(qty_ordered- qty_canceled - qty_refunded)as UNSIGNED) AS qty')->group(array('product_id', 'status'));
			$collection->getSelect()->where('product_id = '. $prodid);
			
			$totalOrder = $collection->getData();
			if(count($totalOrder) > 0) {
				$ret = $totalOrder[0]['qty'];
			}
		}
		return $ret;
	}
}
?>
