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
 * View class for a list of PrayerLine.
 */
class BNMProductHightLightsViewConfigs extends JViewLegacy
{
	protected $items;

	/**
	 * Display the view
	 */
	public function display($tpl = null){
		$this->item		= $this->get('Item');
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			throw new Exception(implode("\n", $errors));
		}
                $this->form = $this->get('Form');
  
		BNMProductHightLightsHelper::addSubmenu('configs');
		$this->addToolbar();
                $this->sidebar = JHtmlSidebar::render();
        
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
    protected function addToolbar(){
        $canDo		= BNMProductHightLightsHelper::getActions('com_bnmproducthightlights');
       
        JToolBarHelper::title(JText::_('Configs'), 'configs');

        // If not checked out, can save the item.
        if (($canDo->get('core.create'))){
            JToolBarHelper::apply('configs.apply', 'JTOOLBAR_APPLY');
        }
    }
}
