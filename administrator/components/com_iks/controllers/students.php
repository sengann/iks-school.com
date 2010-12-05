<?php
/**
 * @version		$Id: banners.php 16398 2010-04-24 00:28:26Z eddieajau $
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

/**
 * Students list controller class.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_iks
 * @since		1.6
 */
class IKSControllerStudents extends JControllerAdmin
{
	
	protected $text_prefix = 'STUDENT';

	public function __construct($config = array())
	{
		parent::__construct($config);
                

		//$this->registerTask('sticky_unpublish',	'sticky_publish');
	}
	
	public function &getModel($name = 'Student', $prefix = 'IKSModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
	
}