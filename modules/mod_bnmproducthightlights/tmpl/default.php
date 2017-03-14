<?php 
/*------------------------------------------------------------------------
* @version   $Id: mod_bnmproducthightlights 2017-03-13 [knigherrant] $
* @author Bold New Media http://www.boldnewmedia.com.au
* @copyright Copyright (C) 2008 - 2015 Bold New Media
* @support support@boldnewmedia.com.au
-------------------------------------------------------------------------*/

$doc = JFactory::getDocument();
$doc->addStyleSheet(JUri::root() . 'modules/mod_bnmproducthightlights/assets/css/frontend.css');
$doc->addScript(JUri::root() . 'modules/mod_bnmproducthightlights/assets/js/frontend.js');
?>
<div id="ProductHightlight<?php echo $module->id ; ?>" class="ProductHightlight <?php echo $moduleclass_sfx; ?>" >
    <?php  BNMProduct::getTemplate(); ?>
</div>