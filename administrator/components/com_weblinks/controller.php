<?php
/**
 * @version		$Id: controller.php 19281 2010-10-29 10:12:49Z eddieajau $
 * @package		Joomla.Administrator
 * @subpackage	com_weblinks
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Weblinks Weblink Controller
 *
 * @package		Joomla.Administrator
 * @subpackage	com_weblinks
 * @since		1.5
 */
class WeblinksController extends JController
{
	/**
	 * Method to display a view.
	 *
	 * @param	boolean			$cachable	If true, the view output will be cached
	 * @param	array			$urlparams	An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return	JController		This object to support chaining.
	 * @since	1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
		require_once JPATH_COMPONENT.'/helpers/weblinks.php';

		// Load the submenu.
		WeblinksHelper::addSubmenu(JRequest::getWord('view', 'weblinks'));

		$view		= JRequest::getWord('view', 'weblinks');
		$layout 	= JRequest::getWord('layout', 'default');
		$id			= JRequest::getInt('id');

		// Check for edit form.
		if ($view == 'weblink' && $layout == 'edit' && !$this->checkEditId('com_weblinks.edit.weblink', $id)) {
			// Somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_weblinks&view=weblinks', false));

			return false;
		}

		parent::display();

		return $this;
	}
}