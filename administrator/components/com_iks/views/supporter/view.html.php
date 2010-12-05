<?php
// No direct access
defined('_JEXEC') or die;
jimport('joomla.application.component.view');
class IKSViewSupporter extends JView
{
    protected $form;
    protected $item;
    protected $state;

    public function display($tpl = null)
    {
        // Initialiase variables.
        $this->form	= $this->get('Form');
        $this->item	= $this->get('Item');
        $this->state	= $this->get('State');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode("\n", $errors));
            return false;
        }

        $this->addToolbar();
        parent::display($tpl);
    }
    protected function addToolbar()
    {
        JRequest::setVar('hidemainmenu', true);

        $user		= JFactory::getUser();
        $isNew		= ($this->item->id == 0);
        $checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
        //$canDo		= PropertyHelper::getActions($this->state->get('filter.category_id'));
        $canDo		= IKSHelper::getActions();

        JToolBarHelper::title($isNew ? JText::_('Add Supporter') : JText::_('Edit Supporter'), 'banners.png');

        // If not checked out, can save the item.
        if (!$checkedOut && ($canDo->get('core.edit')||$canDo->get('core.create'))) {
            JToolBarHelper::apply('supporter.apply', 'JTOOLBAR_APPLY');
            JToolBarHelper::save('supporter.save', 'JTOOLBAR_SAVE');
        }
        if (!$checkedOut && $canDo->get('core.create')) {
            JToolBarHelper::custom('supporter.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
        }
        // If an existing item, can save to a copy.
        if (!$isNew && $canDo->get('core.create')) {
                JToolBarHelper::custom('supporter.save2copy', 'save-copy.png', 'save-copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
        }
        if (empty($this->item->id))
            JToolBarHelper::cancel('supporter.cancel','JTOOLBAR_CANCEL');
        else
            JToolBarHelper::cancel('supporter.cancel', 'JTOOLBAR_CLOSE');


        JToolBarHelper::divider();
        JToolBarHelper::help('supporter');
    }
}
