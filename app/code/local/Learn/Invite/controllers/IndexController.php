<?php
class Learn_Invite_IndexController extends Mage_Core_Controller_Front_Action
{
	public function preDispatch()
	{
		parent::preDispatch();
		$action = $this->getRequest()->getActionName();
		$loginUrl = Mage::helper('customer')->getLoginUrl();	 
		if (!Mage::getSingleton('customer/session')->authenticate($this, $loginUrl)) {
			$this->setFlag('', self::FLAG_NO_DISPATCH, true);
		}
	}
	
    public function indexAction()
	{	
		$data = array();
		$data['friend_name']  = $this->getRequest()->getParam('friend_name');
		$data['friend_email'] = $this->getRequest()->getParam('friend_email');
		$data['customer_id']  =  Mage::getSingleton('customer/session')->getCustomer()->getId();
		$session            = Mage::getSingleton('core/session');
		if($data['customer_id'] && $data['friend_email'] && $data['friend_name']) {
			$data['store_id']  	 =  Mage::app()->getStore()->getStoreId(); 
			$data['created_at']  =  date('Y-m-d H:i:s');
			
			/*- Inserted Data in DB-*/
			$insert_id = Mage::getModel('invite/invite')->setData($data)->save()->getId();
			
			$customer_name =  Mage::getSingleton('customer/session')->getCustomer()->getName();
			$email_data = array(
				"friend_name" 	=> $data['friend_name'],
				"customer_name" => $customer_name,
			);
			
			/*- Send Mail to Invited Friend -*/
			Mage::helper('invite')->customer_email_notify($email_data, $data['friend_email'], $data['friend_name'] );

			$session->addSuccess($this->__('Thank you for your invite.'));
			$this->_redirectReferer();
		} else {
			$session->addException($this->__('There was a problem with the invite.'));
			$this->_redirectReferer();
		}
	}
	
}