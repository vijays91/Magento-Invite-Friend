<?php
class Learn_Invite_Block_Adminhtml_Invite_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('inviteGrid');
        $this->setDefaultSort('invite_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
 
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('invite/invite')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
 
    protected function _prepareColumns()
    {

		$this->addColumn('invite_id', array(
            'header'    => Mage::helper('invite')->__('Invite ID'),
            'align'     => 'center',
			'type'		=> 'number',
            'index'     => 'invite_id',
			'filter' 	=> false,
			'sortable'  => true,
        ));

		$this->addColumn('friend_name', array(
            'header'    => Mage::helper('invite')->__('Friend Name'),
            'align'     => 'left',
            'index'     => 'friend_name',
			/* 'filter' 	=> false,
			'sortable'  => true, */
        ));
		
		$this->addColumn('friend_email', array(
            'header'    => Mage::helper('invite')->__('Friend Email'),
            'align'     => 'left',
            'index'     => 'friend_email',
			/* 'filter' 	=> false,
			'sortable'  => true, */
        ));
		
		
        $this->addColumn('customer_id ', array(
            'header'    => Mage::helper('invite')->__('Customer Name'),
            'align'     => 'left',
			'width'		=> '120px',
            'index'     => 'customer_id',
			'filter' 	=> false,
			'sortable'  => false,
			'renderer'	=> 'Learn_Invite_Block_Adminhtml_Renderer_Customername'
        ));
		

			
		$this->addExportType('*/*/exportCsv', Mage::helper('invite')->__('CSV'));
		// $this->addExportType('*/*/exportXml', Mage::helper('invite')->__('XML'));		
        return parent::_prepareColumns();
    }

	
    public function getGridUrl()
    {
      return $this->getUrl('*/*/grid', array('_current'=>true));
    }
}