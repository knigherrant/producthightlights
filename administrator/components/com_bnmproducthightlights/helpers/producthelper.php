<?php 
/*------------------------------------------------------------------------
* @version   $Id: com_bnmproducthightlights 2017-03-13 [knigherrant] $
* @author Bold New Media http://www.boldnewmedia.com.au
* @copyright Copyright (C) 2008 - 2015 Bold New Media
* @support support@boldnewmedia.com.au
-------------------------------------------------------------------------*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

 if(!function_exists('k')){
	 function k($str){
		 //if($_SERVER['REMOTE_ADDR'] == '14.161.35.175' || $_SERVER['REMOTE_ADDR'] == '::1' || $_SERVER['SERVER_NAME'] == 'localhost'){
			if($str){
				echo "<pre>";
				print_R($str);
				echo "</pre>";
			}else{
				echo "<pre>";
				var_dump($str);
				echo "</pre>";
			}
		//}
	 }
 }

class BNMProductHightLightsHelper extends JHelperContent{
    public static function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_BNMPRODUCTHIGHTLIGHTS_MENU_PRODUCT_TITLE'),
			'index.php?option=com_bnmproducthightlights&view=products',
			$vName == 'products'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_BNMPRODUCTHIGHTLIGHTS_MENU_CONFIG_TITLE'),
			'index.php?option=com_bnmproducthightlights&view=configs',
			$vName == 'configs'
		);

		
	}
        
}

class BNMProduct extends BNMProductHightLightsHelper{
    
}