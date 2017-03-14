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
    
    static $pathTemplate = '/components/com_bnmproducthightlights/templates/';
    
    public static function listFolder(){
        jimport('joomla.filesystem.folder');
        jimport('joomla.filesystem.file');
        $lists = JFolder::folders(JPATH_SITE . self::$pathTemplate);
        return $lists;
    }
    
    public static function listTemplate($selected = ''){
        $lists = self::listFolder();
        //$options[] = JHTML::_('select.option','', '- Select Category -');
        $options = array();
        foreach ($lists as $l){
            $options[] = JHTML::_('select.option',$l, ucfirst($l));
        }
        return JHTML::_('select.genericlist', $options, 'template', 'class="inputbox" ', 'value', 'text', $selected);
    }
    public static function extractArchive($filename){
                $path = JPATH_SITE . self::$pathTemplate;
                $zip = new ZipArchive;
                $app = JFactory::getApplication();
                if ($zip->open($path . $filename) === true) {
                        for ($i = 0; $i < $zip->numFiles; $i++) {
                                $entry = $zip->getNameIndex($i);
                                if (file_exists(JPath::clean($path . '/' . $entry))) {
                                        $app->enqueueMessage(JText::_('COM_BNMPRODUCTHIGHTLIGHTS_FILE_ARCHIVE_EXISTS'), 'error');

                                        return false;
                                }
                        }

                        $zip->extractTo($path);
                        $zip->close();
                        unlink($path . $filename);
                        return true;
                }
                else
                {
                        unlink($path . $filename);
                        $app->enqueueMessage(JText::_('COM_BNMPRODUCTHIGHTLIGHTS_FILE_ARCHIVE_OPEN_FAIL'), 'error');
                        return false;
                }
        
    }
    
    public static function getConfig(){
        static $cfg;
        if(isset($cfg)) return $cfg;
        $db = JFactory::getDbo();
        $cfg = $db->setQuery('SELECT * FROM #__producthightlights_config WHERE id=1')->loadObject();
        $cfg->params = json_decode($cfg->params);
        return $cfg;
    }
    
    
    
    public static function getTemplate(){
        $configs = self::getConfig();
        $app = JFactory::getApplication();
        if(!$configs->template){
            $app->enqueueMessage(JText::_('Please select template in administrar'), 'error');
            return;
        }
        $override = JPATH_SITE . '/templates/' . $app->getTemplate() . '/html/com_bnmproducthightlights/templates/' . $configs->template . '/default.php';
        $default = JPATH_SITE . '/components/com_bnmproducthightlights/templates/' . $configs->template . '/default.php';
        if(file_exists($override)) include_once $override;
        else{
            if(file_exists($default)) include_once $default;
            else{
                $app->enqueueMessage(JText::_("The template $configs->template not found"), 'error');
                return;
            }
        }
        
    }
    
    
}