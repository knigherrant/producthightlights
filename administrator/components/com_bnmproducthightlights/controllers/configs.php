<?php 
/*------------------------------------------------------------------------
* @version   $Id: com_bnmproducthightlights 2017-03-13 [knigherrant] $
* @author Bold New Media http://www.boldnewmedia.com.au
* @copyright Copyright (C) 2008 - 2015 Bold New Media
* @support support@boldnewmedia.com.au
-------------------------------------------------------------------------*/
// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

/**
 * Documents list controller class.
 */
class BNMProductHightLightsControllerConfigs extends JControllerAdmin
{
    public function __construct($config = array())
    {
        parent::__construct($config);
        $this->registerTask('save',	'save');
        $this->registerTask('apply', 'save');
    }
	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function getModel($name = 'configs', $prefix = 'BNMProductHightLightsModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}

    public function getConfigs(){
        $options = $this->getModel()->getItems();
        $options->params = json_decode($options->params);
        exit(json_encode(array('options'=>$options, 'extensions'=>$extensions)));
    }

    public function save(){
        $model = $this->getModel();
        $post = JRequest::get('post');
        if($_FILES['jtemplate']['name']){
            jimport('joomla.filesystem.folder');
            jimport('joomla.filesystem.file');
            $name = time() . '_' . $_FILES['jtemplate']['name'];
            if(move_uploaded_file($_FILES['jtemplate']['tmp_name'], JPATH_SITE . BNMProduct::$pathTemplate. $name)){
                if(!BNMProduct::extractArchive($name)){
                    $this->setRedirect('index.php?option=com_bnmproducthightlights&view=configs', 'Upload Template error!','error');
                    return;
                }
            }else{
                 $this->setRedirect('index.php?option=com_bnmproducthightlights&view=configs', 'Upload Template error!','error');
                 return;
            }
        }
        $model->save($post);
        if($this->getTask() == 'apply') $this->setRedirect('index.php?option=com_bnmproducthightlights&view=configs', 'Saved!');
        else $this->setRedirect('index.php?option=com_bnmproducthightlights&view=products', 'Saved!');
    }
}