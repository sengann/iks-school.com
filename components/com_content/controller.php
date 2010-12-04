<?php
/**
 * @version		$Id: controller.php 19409 2010-11-08 20:55:46Z ian $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

/**
 * Content Component Controller
 *
 * @package		Joomla.Site
 * @subpackage	com_content
 * @since		1.5
 */
class ContentController extends JController
{
	function __construct($config = array())
	{
		// Article frontpage Editor pagebreak proxying:
		if(JRequest::getWord('view') === 'article' && JRequest::getVar('layout') === 'pagebreak') {
			$config['base_path'] = JPATH_COMPONENT_ADMINISTRATOR;
		}
		// Article frontpage Editor article proxying:
		elseif(JRequest::getWord('view') === 'articles' && JRequest::getVar('layout') === 'modal') {
			JHTML::_('stylesheet','system/adminlist.css', array(), true);
			$config['base_path'] = JPATH_COMPONENT_ADMINISTRATOR;
		}

		parent::__construct($config);
	}

	/**
	 * Method to display a view.
	 *
	 * @param	boolean			If true, the view output will be cached
	 * @param	array			An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return	JController		This object to support chaining.
	 * @since	1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
		$cachable = true;

		JHTML::_('behavior.caption');

		// Set the default view name and format from the Request.
		$id		= JRequest::getInt('id');
		$vName	= JRequest::getWord('view', 'categories');
		JRequest::setVar('view', $vName);

		$user = JFactory::getUser();

		if ($user->get('id') || ($_SERVER['REQUEST_METHOD'] == 'POST' &&
			(($vName = 'category' && JRequest::getVar('layout') != 'blog') || $vName = 'archive' ))) {
			$cachable = false;
		}

		$safeurlparams = array('catid'=>'INT','id'=>'INT','cid'=>'ARRAY','year'=>'INT','month'=>'INT','limit'=>'INT','limitstart'=>'INT',
			'showall'=>'INT','return'=>'BASE64','filter'=>'STRING','filter_order'=>'CMD','filter_order_Dir'=>'CMD','filter-search'=>'STRING','print'=>'BOOLEAN','lang'=>'CMD');

		// Check for edit form.
		if ($vName == 'form' && !$this->checkEditId('com_content.edit.article', $id)) {
			// Somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php', false));

			return false;
		}

		parent::display($cachable, $safeurlparams);

		return $this;
	}


	function vote() {
		$user_rating = JRequest::getInt('user_rating', -1);

		if ( $user_rating > -1 )
		{
			$url = JRequest::getString('url', '');
			$id = JRequest::getInt('id', 0);
			$viewName = JRequest::getString('view', $this->default_view);
			$model = $this->getModel($viewName);

			if ($model->storeVote($id, $user_rating)) {
				$this->setRedirect($url, JText::_('COM_CONTENT_ARTICLE_VOTE_SUCCESS'));
			} else {
				$this->setRedirect($url, JText::_('COM_CONTENT_ARTICLE_VOTE_FAILURE'));
			}
		}
	}

}