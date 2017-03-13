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
        $model->save($post);
        if($this->getTask() == 'apply') $this->setRedirect('index.php?option=com_bnmproducthightlights&view=configs', 'Saved!');
        else $this->setRedirect('index.php?option=com_bnmproducthightlights&view=documents', 'Saved!');
    }
}