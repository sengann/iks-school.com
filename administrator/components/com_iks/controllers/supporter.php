<?php
// no direct access
defined('_JEXEC') or die;
jimport('joomla.application.component.controllerform');
class IKSControllerSupporter extends JControllerForm
{
    protected $text_prefix = 'IKS';
    protected function allowAdd($data = array())
    {
        // Initialise variables.
        $user		= JFactory::getUser();
        $OwnerId	= JArrayHelper::getValue($data, 'id', JRequest::getInt('filter_owner_id'), 'int');
        $allow		= null;

        if ($OwnerId) {
                // If the category has been passed in the URL check it.
                $allow	= $user->authorise('core.create', $this->option.'.owner.'.$OwnerId);
        }

        if ($allow === null) {
                // In the absense of better information, revert to the component permissions.
                return parent::allowAdd($data);
        } else {
                return $allow;
        }
    }


    protected function allowEdit($data = array(), $key = 'id')
    {
        // Initialise variables.
        $recordId	= (int) isset($data[$key]) ? $data[$key] : 0;
        $OwnerId = 0;

        if ($recordId) {
                $OwnerId = (int) $this->getModel()->getItem($recordId)->id;
        }

        if ($OwnerId) {
                // The category has been set. Check the category permissions.
                return JFactory::getUser()->authorise('core.edit', $this->option.'.owner.'.$OwnerId);
        } else {
                // Since there is no asset tracking, revert to the component permissions.
                return parent::allowEdit($data, $key);
        }
    }
}