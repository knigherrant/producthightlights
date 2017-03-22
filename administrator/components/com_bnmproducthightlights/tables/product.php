<?php 
/*------------------------------------------------------------------------
* @version   $Id: com_bnmproducthightlights 2017-03-13 [knigherrant] $
* @author Bold New Media http://www.boldnewmedia.com.au
* @copyright Copyright (C) 2008 - 2015 Bold New Media
* @support support@boldnewmedia.com.au
-------------------------------------------------------------------------*/

// No direct access.
defined('_JEXEC') or die;

/**
 * 
 * Table class
 * @author Sakis Terz
 *
 */
class BNMProductHightLightsTableProduct extends JTable{
/**
	 * Constructor
	 *
	 * @since	1.5
	 */
	function __construct(&$_db)
	{
		parent::__construct('#__producthightlights', 'id', $_db);
	}
}