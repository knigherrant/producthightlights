<?php 
/*------------------------------------------------------------------------
* @version   $Id: mod_bnmproducthightlights 2017-03-13 [knigherrant] $
* @author Bold New Media http://www.boldnewmedia.com.au
* @copyright Copyright (C) 2008 - 2015 Bold New Media
* @support support@boldnewmedia.com.au
-------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
require_once JPATH_SITE .'/administrator/components/com_bnmproducthightlights/helpers/producthelper.php';  
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
require JModuleHelper::getLayoutPath('mod_bnmproducthightlights', $params->get('layout'));
