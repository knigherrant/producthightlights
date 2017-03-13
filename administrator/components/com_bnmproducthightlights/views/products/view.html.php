<?php 
/*------------------------------------------------------------------------
* @version   $Id: com_bnmproducthightlights 2017-03-13 [knigherrant] $
* @author Bold New Media http://www.boldnewmedia.com.au
* @copyright Copyright (C) 2008 - 2015 Bold New Media
* @support support@boldnewmedia.com.au
-------------------------------------------------------------------------*/
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View class for a list of BNMProductHightLights.
 */
class BNMProductHightLightsViewProducts extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->state		= $this->get('State');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			throw new Exception(implode("\n", $errors));
		}
        
		BNMProductHightLightsHelper::addSubmenu('products');
		$this->addToolbar();
                $this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
            $state	= $this->get('State');
            $canDo	= BNMProductHightLightsHelper::getActions('com_bnmproducthightlights');
            JToolBarHelper::title(JText::_('COM_BNMPRODUCTHIGHTLIGHTS_MENU_PRODUCT_TITLE'), 'product');


            //Check if the form exists before showing the add/edit buttons
            $formPath = JPATH_COMPONENT_ADMINISTRATOR.'/views/product';

            if (file_exists($formPath)) {
                if ($canDo->get('core.create')) {
                                JToolBarHelper::addNew('product.add','JTOOLBAR_NEW');
                        }
                        if ($canDo->get('core.edit') && isset($this->items[0])) {
                                JToolBarHelper::editList('product.edit','JTOOLBAR_EDIT');
                        }
            }

            if ($canDo->get('core.edit.state')) {
                if (isset($this->items[0]->state)) {

                    JToolBarHelper::divider();
                    JToolBarHelper::custom('products.publish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);
                    JToolBarHelper::custom('products.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
                }
                if (isset($this->items[0])) {
                    JToolBarHelper::deleteList('', 'products.delete','JTOOLBAR_DELETE');
                }
                if (isset($this->items[0]->checked_out)) {
                    JToolBarHelper::custom('products.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
                }
            }


       
        if ($canDo->get('core.admin')) {
            //JToolBarHelper::preferences('com_bnmproducthightlights');
        }
	}
    
	protected function getSortFields()
	{
		return array(
            'a.state' => JText::_('JSTATUS'),
            'a.title' => JText::_('COM_METIKACCMGR_TITLE'),
            'access_title' => JText::_('COM_METIKACCMGR_ACCESS'),
            'cat_title' => JText::_('COM_METIKACCMGR_CATEGORY'),
            'created_by_name' => JText::_('COM_METIKACCMGR_OWNER'),
            'a.created' => JText::_('COM_METIKACCMGR_CREATED'),
            'a.id' => JText::_('JGRID_HEADING_ID'),
        );
	}

    
}
