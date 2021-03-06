<?php
/**
 * @version		$Id: category.php 19322 2010-11-02 08:30:33Z infograf768 $
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * The Menu Item Controller
 *
 * @package		Joomla.Administrator
 * @subpackage	com_categories
 * @since		1.6
 */
class CategoriesControllerCategory extends JControllerForm
{
	/**
	 * @var		string	The extension for which the categories apply.
	 * @since	1.6
	 */
	protected $extension;

	/**
	 * Constructor.
	 *
	 * @param	array An optional associative array of configuration settings.
	 * @see		JController
	 * @since	1.6
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);

		// Guess the JText message prefix. Defaults to the option.
		if (empty($this->extension)) {
			$this->extension = JRequest::getCmd('extension', 'com_content');
		}
	}

	/**
	 * Method to check if you can add a new record.
 	 *
	 * Extended classes can override this if necessary.
 	 *
	 * @param	array	An array of input data.
 	 *
	 * @return	boolean
	 * @since	1.6
 	 */
	protected function allowAdd($data = array())
 	{
		return JFactory::getUser()->authorise('core.create', $this->extension);
 	}

 	/**
	 * Method to check if you can edit a record.
 	 *
	 * Extended classes can override this if necessary.
	 *
	 * @param	array	An array of input data.
	 * @param	string	The name of the key for the primary key.
	 *
	 * @return	boolean
	 * @since	1.6
 	 */
 	protected function allowEdit($data = array(), $key = 'parent_id')
 	{
		// Initialise variables.
		$recordId  = (int) isset($data[$key]) ? $data[$key] : 0;
		$user		= JFactory::getUser();
		$userId		= $user->get('id');

		// Check general edit permission first.
		if ($user->authorise('core.edit', $this->extension)) {
		  return true;
		}

		// Check specific edit permission.
		if ($user->authorise('core.edit', $this->extension.'.category.'.$recordId)) {
		  return true;
		}

		// Fallback on edit.own.
		// First test if the permission is available.
		if ($user->authorise('core.edit.own', $this->extension.'.category.'.$recordId) || $user->authorise('core.edit.own', $this->extension)) {
		  // Now test the owner is the user.
		  $ownerId  = (int) isset($data['created_user_id']) ? $data['created_user_id'] : 0;
		  if (empty($ownerId) && $recordId) {
				// Need to do a lookup from the model.
				$record		= $this->getModel()->getItem($recordId);

				if (empty($record)) {
				  return false;
				}

				$ownerId = $record->created_user_id;
		  }

		  // If the owner matches 'me' then do the test.
		  if ($ownerId == $userId) {
				return true;
		  }
		}
		return false;
   }

 	/**
	 * Method to run batch opterations.
 	 *
 	 * @return	void
 	 */
	public function batch()
 	{
 		JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

 		// Initialise variables.
 		$app	= JFactory::getApplication();
 		$model	= $this->getModel('Category');
		$vars	= JRequest::getVar('batch', array(), 'post', 'array');
		$cid	= JRequest::getVar('cid', array(), 'post', 'array');

 		$extension = JRequest::getCmd('extension', '');
 		if ($extension) {
 			$extension = '&extension='.$extension;
 		}

		// Preset the redirect
		$this->setRedirect('index.php?option=com_categories&view=categories'.$extension);

		// Attempt to run the batch operation.
		if ($model->batch($vars, $cid)) {
			$this->setMessage(JText::_('COM_CATEGORIES_BATCH_SUCCESS'));
			return true;
 		} else {
			$this->setMessage(JText::_(JText::sprintf('COM_CATEGORIES_ERROR_BATCH_FAILED', $model->getError())));
			return false;
 		}
	}

 	/**
	 * Gets the URL arguments to append to an item redirect.
 	 *
	 * @param	int		$recordId	The primary key id for the item.
	 *
	 * @return	string	The arguments to append to the redirect URL.
	 * @since	1.6
 	 */
	protected function getRedirectToItemAppend($recordId = null)
 	{
		$append = parent::getRedirectToItemAppend($recordId);
		$append .= '&extension='.$this->extension;

		return $append;
	}

	/**
	 * Gets the URL arguments to append to a list redirect.
	 *
	 * @return	string	The arguments to append to the redirect URL.
	 * @since	1.6
	 */
	protected function getRedirectToListAppend()
	{
		$append = parent::getRedirectToListAppend();
		$append .= '&extension='.$this->extension;

		return $append;
 	}
}
