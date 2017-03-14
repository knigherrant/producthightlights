<?php 
/*------------------------------------------------------------------------
* @version   $Id: com_bnmproducthightlights 2017-03-13 [knigherrant] $
* @author Bold New Media http://www.boldnewmedia.com.au
* @copyright Copyright (C) 2008 - 2015 Bold New Media
* @support support@boldnewmedia.com.au
-------------------------------------------------------------------------*/
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');
jimport('joomla.application.component.modeladmin');
/**
 * Methods supporting a list of BNMProductHightLights records.
 */
class BNMProductHightLightsModelConfigs extends JModelAdmin {

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array()) {
        parent::__construct($config);
    }

    public function getTable($type = 'Config', $prefix = 'BNMProductHightLightsTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		An optional array of data for the form to interogate.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	JForm	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Initialise variables.
		$app	= JFactory::getApplication();

		// Get the form.
		$form = $this->loadForm('com_bnmproducthightlights.config', 'config', array('control' => 'jform', 'load_data' => $loadData));
                
        
		if (empty($form)) {
			return false;
		}
              
		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_bnmproducthightlights.edit.config.data', array());

		if (empty($data)) {
			$data = $this->getItem();
            
		}
		return $data;
	}
    
    
    /**
     * Build an SQL query to load the list data.
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    protected function getListQuery() {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
                $this->getState(
                        'list.select', 'a.*'
                )
        );
        $query->from('`#__mobile_config` AS a');

        return $query;
    }

    public function getItem($pk = 1) {
        $item = parent::getItem($pk);
        return $item;
    }

    public function save($data){
        //$post  = JFactory::getApplication()->input->get('post');
        
        $post = JRequest::get('post');
        $post['params'] = JFactory::getApplication()->input->get('params', '', 'raw');
        $post['params'] = json_encode($post['params']);
        $table = JTable::getInstance('config','BNMProductHightLightsTable');
        $table->load(1);
        $table->bind($post);
        $table->store();
    }

}
