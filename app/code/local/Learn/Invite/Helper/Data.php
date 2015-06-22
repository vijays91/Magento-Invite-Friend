<?php
class Learn_Invite_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_INVITE_ENABLE   	= 'invite_tab/invite_setting/invite_active';
    const XML_PATH_INVITE_POSITION   	= 'invite_tab/invite_setting/invite_position';
    const XML_PATH_INVITE_SUBJECT   	= 'invite_tab/invite_setting/invite_subject';
	
	public function conf($code, $store = null) {
        return Mage::getStoreConfig($code, $store);
    }
	
	public function invite_enable($store) {
		return $this->conf(self::XML_PATH_INVITE_ENABLE, $store);
	}
	public function invite_position($store) {
		return $this->conf(self::XML_PATH_INVITE_POSITION, $store);
	}
	
	public function postion_left() {
		if(self::invite_enable() == 1 && self::invite_position() == 1) {
			return "friend_invite/friend_invite.phtml";
		}
		return false;
	}
	public function postion_right() {
		if(self::invite_enable() == 1 && self::invite_position() == 2) {
			return "friend_invite/friend_invite.phtml";
		}
		return false;
	}
	
	public function dynamic_subject() {
		return $this->conf(self::XML_PATH_INVITE_SUBJECT, $store);
	}
	
	public function admin_notify_emailId() {
		$admin = Mage::getStoreConfig('invite_tab/invite_setting/invite_administrator');     
		return Mage::getStoreConfig('trans_email/ident_'.$admin.'/email', $store);
	}
	
	public function admin_notify_name() {
		$admin = Mage::getStoreConfig('invite_tab/invite_setting/invite_administrator');     
		return Mage::getStoreConfig('trans_email/ident_'.$admin.'/name', $store);
	}
	
	public function customer_email_notify($data, $friend_email_id, $friend_email_name ) 
	{
		$invite_template  = Mage::getModel('core/email_template')->loadDefault('invite_tab_invite_setting_template');
		$fInvite_template = $invite_template->getProcessedTemplate($data);
		
		$adminSalesRepEmail = $this->admin_notify_emailId();
		$adminSalesRepName = $this->admin_notify_name();
		
		$subject = $this->dynamic_subject();
		
		// Send the Mail to Customer
		$mail = Mage::getModel('core/email')
			->setToName($friend_email_name)
			->setToEmail($friend_email_id)
			->setBody($fInvite_template)
			->setSubject($subject)
			->setFromEmail($adminSalesRepEmail)
			->setFromName($adminSalesRepName)
			->setType('html');
		try {
			$mail->send();
		}
		catch(Exception $error) {
			Mage::getSingleton('core/session')->addError($error->getMessage());
			//echo $error->getMessage();
		}
	}
}
