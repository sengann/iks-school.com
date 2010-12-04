<?php
/**
 * @version		$Id: banners.php 17858 2010-06-23 17:54:28Z eddieajau $
 * @package		Joomla.Administrator
 * @subpackage	com_iks
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_iks')) {
    ch_debug('load component',1);
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
jimport('joomla.application.component.controller');

// Execute the task.
$controller	= JController::getInstance('iks');

$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
