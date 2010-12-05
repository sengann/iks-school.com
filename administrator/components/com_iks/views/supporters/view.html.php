<?php
/**
 * @version		$Id: view.html.php 19253 2010-10-28 22:25:26Z eddieajau $
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');


/**
 * View class for a list of banners.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_iks
 * @since		1.6
 */
class IKSViewsupporters extends JView
{
	//protected $categories;
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{ 
		// Initialise variables.
		//$this->categories	= $this->get('CategoryOrders');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		//require_once JPATH_COMPONENT .'/models/fields/bannerclient.php';
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		require_once JPATH_COMPONENT.'/helpers/iks.php';

		$canDo	= IKSHelper::getActions($this->state->get('filter.id'));

		JToolBarHelper::title(JText::_('supporter Management'), 'banners.png');
		if ($canDo->get('core.create')) {
			JToolBarHelper::addNew('supporter.add','JTOOLBAR_NEW');
		}

		if (($canDo->get('core.edit'))) {
			JToolBarHelper::editList('supporter.edit','JTOOLBAR_EDIT');
		}

		if ($canDo->get('core.edit.state')) {
			if ($this->state->get('filter.state') != 2){
				JToolBarHelper::divider();
				JToolBarHelper::custom('supporters.publish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);
				JToolBarHelper::custom('supporters.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
			}

			if ($this->state->get('filter.state') != -1 ) {
				JToolBarHelper::divider();
				if ($this->state->get('filter.state') != 2) {
					JToolBarHelper::archiveList('supporter.archive','JTOOLBAR_ARCHIVE');
				}
				else if ($this->state->get('filter.state') == 2) {
					JToolBarHelper::unarchiveList('supporters.publish', 'JTOOLBAR_UNARCHIVE');
				}
			}
		}

		if ($canDo->get('core.edit.state')) {
			JToolBarHelper::custom('supporters.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
		}

		if ($this->state->get('filter.state') == -2 && $canDo->get('core.delete')) {
			JToolBarHelper::deleteList('', 'supporters.delete','JTOOLBAR_EMPTY_TRASH');
			JToolBarHelper::divider();
		}
		else if ($canDo->get('core.edit.state')) {
			JToolBarHelper::trash('supporters.trash','JTOOLBAR_TRASH');
			JToolBarHelper::divider();
		}

		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_iks');
			JToolBarHelper::divider();
		}
		JToolBarHelper::help('Help');
	}
}
