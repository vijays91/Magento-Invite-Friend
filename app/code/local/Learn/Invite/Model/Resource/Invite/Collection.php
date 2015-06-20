<?php
class Learn_Invite_Model_Resource_Invite_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('invite/invite');
    }
}

