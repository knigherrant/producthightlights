<?php 
/*------------------------------------------------------------------------
* @version   $Id: mod_bnmproducthightlights 2017-03-13 [knigherrant] $
* @author Bold New Media http://www.boldnewmedia.com.au
* @copyright Copyright (C) 2008 - 2015 Bold New Media
* @support support@boldnewmedia.com.au
-------------------------------------------------------------------------*/
defined('_JEXEC') or die('Restricted access');
 
jimport('joomla.form.formfield');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
// The class name must always be the same as the filename (in camel case)
class JFormFieldJskin extends JFormField {
 
        //The field class must know its own type through the variable $type.
        protected $type = 'jskin';
 
       
        
}