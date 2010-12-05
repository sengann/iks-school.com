<?php
// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class IKSControllerProvinces extends JControllerAdmin
{
	protected $text_prefix = 'Provinces';
	public function __construct($config = array())
	{
		parent::__construct($config);
		//$this->registerTask('unpublish',	'publish');
	}

	public function &getModel($name = 'Province', $prefix = 'IKSModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}

}