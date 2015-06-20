<?php
class Learn_Invite_Adminhtml_InviteController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
		$this->loadLayout()->_setActiveMenu('invite/items')
		->_addBreadcrumb(Mage::helper('adminhtml')->__('Invite Form '), Mage::helper('adminhtml')->__('invite Form'));
		return $this;
    }  
	
    public function indexAction() 
	{
        $this->_initAction();
        $this->_addContent($this->getLayout()->createBlock('invite/adminhtml_invite'));
        $this->renderLayout();
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
               $this->getLayout()->createBlock('invite/adminhtml_invite_grid')->toHtml()
        );
    }
	
	/*- Export in CSV -*/
	public function exportCsvAction()
    {
		$fileName   = 'product_invite.csv';
		$content    = $this->getLayout()->createBlock('invite/adminhtml_invite_grid')->getCsv(); 
		$this->_prepareDownloadResponse($fileName, $content);
    }
	
	/*- Export in XML -*/
    public function exportXmlAction()
    {
        $fileName   = 'product_invite.xml';
        $content    = $this->getLayout()->createBlock('invite/adminhtml_invite_grid')->getXml(); 
        $this->_prepareDownloadResponse($fileName, $content);
    }
	
	
}