<?php
class Learn_Invite_Model_Resource_Invite extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('invite/invite', 'invite_id');
    }
}