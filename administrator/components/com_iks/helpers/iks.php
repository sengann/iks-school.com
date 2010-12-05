<?php
class IKSHelper
{
	
	public static function addSubmenu($vName)
	{
		JSubMenuHelper::addEntry(
			JText::_('Cpanel'),
			'index.php?option=com_iks&view=iks',
			$vName == 'iks'
		);
		

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
                JSubMenuHelper::addEntry(
			JText::_('Provinces'),
			'index.php?option=com_iks&view=provinces',
			$vName == 'Province'
		);
	}

	
	public static function getActions($id = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;
               
		if (empty($id)) {
			$assetName = 'com_iks';
		} else {
			$assetName = 'com_iks.students.'.(int) $id;
		}

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action,	$user->authorise($action, $assetName));
		}

		return $result;
	}

      

	
}