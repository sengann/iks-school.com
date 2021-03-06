<?php
// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class IKSControllerSupporter extends JControllerAdmin
{

	protected $text_prefix = 'IKS';

	
	public function __construct($config = array())
	{
		parent::__construct($config);

		//$this->registerTask('sticky_unpublish',	'sticky_publish');
	}

	
	public function &getModel($name = 'Supporter', $prefix = 'IKSModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}

	
}