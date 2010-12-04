<?php
/**
 * @version		$Id: banners.php 19253 2010-10-28 22:25:26Z eddieajau $
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

/**
 * Banners component helper.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_banners
 * @since		1.6
 */
class IKSHelper
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param	string	The name of the active view.
	 *
	 * @return	void
	 * @since	1.6
	 */
	public static function addSubmenu($vName)
	{
		JSubMenuHelper::addEntry(
			JText::_('Cpanel'),
			'index.php?option=com_iks&view=iks',
			$vName == 'iks'
		);

		/*JSubMenuHelper::addEntry(
			JText::_('COM_BANNERS_SUBMENU_CATEGORIES'),
			'index.php?option=com_categories&extension=com_banners',
			$vName == 'categories'
		);
		if ($vName=='categories') {
			JToolBarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE',JText::_('com_banners')),
				'banners-categories');
		}*/

		JSubMenuHelper::addEntry(
			JText::_('Students'),
			'index.php?option=com_iks&view=students',
			$vName == 'students'
		);

		JSubMenuHelper::addEntry(
			JText::_('Supporters'),
			'index.php?option=com_iks&view=supporters',
			$vName == 'supporters'
		);
	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @param	int		The category ID.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions($studentId = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		if (empty($studentId)) {
			$assetName = 'com_iks';
		} else {
			$assetName = 'com_iks.students.'.(int) $studentId;
		}

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action,	$user->authorise($action, $assetName));
		}

		return $result;
	}

      

	/**
	 * @return	boolean
	 * @since	1.6
	 */
	/*public static function updateReset()
	{
		$user = JFactory::getUser();
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('#__s');
		$query->where('NOW() >= `reset`');
		$query->where('`reset` != '.$db->quote('0000-00-00 00:00:00').' AND `reset`!=NULL');
		$query->where('(`checked_out` = 0 OR `checked_out` = '.(int) $db->Quote($user->id).')');
		$db->setQuery((string)$query);
		$rows = $db->loadObjectList();

		// Check for a database error.
		if ($db->getErrorNum()) {
			JError::raiseWarning(500, $db->getErrorMsg());
			return false;
		}

		JTable::addIncludePath(JPATH_ROOT.'/administrator/components/com_banners/tables');

		foreach ($rows as $row) {
			$purchase_type = $row->purchase_type;

			if ($purchase_type < 0 && $row->cid) {
				$client = JTable::getInstance('Client','BannersTable');
				$client->load($row->cid);
				$purchase_type = $client->purchase_type;
			}

			if ($purchase_type < 0) {
				$params = JComponentHelper::getParams('com_banners');
				$purchase_type = $params->get('purchase_type');
			}

			switch($purchase_type) {
				case 1:
					$reset='0000-00-00 00:00:00';
					break;
				case 2:
					$reset = JFactory::getDate('+1 year '.date('Y-m-d',strtotime('now')))->toMySQL();
					break;
				case 3:
					$reset = JFactory::getDate('+1 month '.date('Y-m-d',strtotime('now')))->toMySQL();
					break;
				case 4:
					$reset = JFactory::getDate('+7 day '.date('Y-m-d',strtotime('now')))->toMySQL();
					break;
				case 5:
					$reset = JFactory::getDate('+1 day '.date('Y-m-d',strtotime('now')))->toMySQL();
					break;
			}

			// Update the row ordering field.
			$query->clear();
			$query->update('`#__banners`');
			$query->set('`reset` = '.$db->quote($reset));
			$query->set('`impmade` = '.$db->quote(0));
			$query->set('`clicks` = '.$db->quote(0));
			$query->where('`id` = '.$db->quote($row->id));
			$db->setQuery((string)$query);
			$db->query();

			// Check for a database error.
			if ($db->getErrorNum()) {
				JError::raiseWarning(500, $db->getErrorMsg());
				return false;
			}
		}

		return true;
	}*/
}