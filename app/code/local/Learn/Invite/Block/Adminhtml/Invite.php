<?php
class Learn_Invite_Block_Adminhtml_Invite extends Mage_Adminhtml_Block_Widget_Grid_Container
{ 
   public function __construct()
    {
        $this->_controller = 'adminhtml_invite';
        $this->_blockGroup = 'invite';
        $this->_headerText = Mage::helper('invite')->__('Friend Invite Report');
        parent::__construct();
		$this->_removeButton('add');
    }
}
?>