<?php 
/*------------------------------------------------------------------------
* @version   $Id: com_bnmproducthightlights 2017-03-13 [knigherrant] $
* @author Bold New Media http://www.boldnewmedia.com.au
* @copyright Copyright (C) 2008 - 2015 Bold New Media
* @support support@boldnewmedia.com.au
-------------------------------------------------------------------------*/
?>
<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.installer.helper');
jimport('joomla.filesystem.folder');

if(!class_exists('com_bnmproducthightlightsInstallerScript')){
	class com_bnmproducthightlightsInstallerScript {
		function install($parent) {
			JVInstaller::processInstall ( $parent );
		}
		
		function uninstall($parent)
		{
			JVInstaller::uninstall ( $parent );
		}
		
		function update($parent)
		{
			JVInstaller::processUpdate ( $parent );
		}
	}
}


class JVInstaller extends JObject {

	public static $success = array();

	public static function processInstall(&$component) {
		$installer = new JInstaller();
		$installer->setOverwrite(true);

		$folder = $component->get ( 'parent' )->getPath ( 'source' );
		$extentions = JFolder::folders ($folder . '/extensions/') ; 

		foreach( $extentions as $extention ){
				$installer->install( $folder . '/extensions/' . $extention );
				self::$success[] = $installer;
		}
		self::displayResults ();
	}
	public static function processUpdate(&$component){
		self::processInstall($component);
	}
	public static function uninstall(&$component) { }

	public static function displayResults() {
		?>
		<h3 style="
			border-top: 1px solid #CCC;
			padding-top: 30px;
			color: green;
			font-weight: bold;
			font-size: 18px;
		">Product Highlights Installation Status:</h3>
		<table class="adminlist table table-striped">
			<thead>
				<tr>
					<th width="30%">Name</th>		
					<th width="70%">Message</th>
				</tr>
			</thead>	
			<tbody>
		<?php 	foreach ( self::$success as $i => $extension ): ?>		
		
				<tr class="row<?php echo $i++ % 2; ?>">
					<td><?php echo (string) $extension->manifest->name; ?></td>
					<td>
						<?php $style  = 'font-weight: bold; color: green;'; ?>
						<span style="<?php echo $style; ?>"><?php echo $extension->message; ?></span>
					</td>
				</tr>
		<?php 	endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
			</tfoot>
		</table>

		<?php
	
	}
	
	
}

