<?php 
/*------------------------------------------------------------------------
* @version   $Id: com_bnmproducthightlights 2017-03-13 [knigherrant] $
* @author Bold New Media http://www.boldnewmedia.com.au
* @copyright Copyright (C) 2008 - 2015 Bold New Media
* @support support@boldnewmedia.com.au
-------------------------------------------------------------------------*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_bnmproducthightlights')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}
require_once JPATH_COMPONENT . '/helpers/producthelper.php';
// Include dependancies
jimport('joomla.application.component.controller');
$controller	= JControllerLegacy::getInstance('BNMProductHightLights');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
