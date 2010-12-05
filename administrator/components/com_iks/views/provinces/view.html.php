<?php
// No direct access
defined('_JEXEC') or die;
jimport('joomla.application.component.view');

class IKSViewProvinces extends JView
{
    protected $items;
    protected $pagination;
    protected $state;

    public function display($tpl = null)
    {
        $this->items		= $this->get('Items');
        $this->pagination	= $this->get('Pagination');
        $this->state		= $this->get('State');
        // Check for errors.
        $errors = $this->get('Errors');
        if (count($errors)) {
                JError::raiseError(500, implode("\n", $errors));
                return false;
        }
        $this->addToolbar();
        parent::display($tpl);
    }

    protected function addToolbar()
    {
        require_once JPATH_COMPONENT.'/helpers/iks.php';
        $filter_id = $this->state->get('filter.id');
        $canDo	= IKSHelper::getActions($filter_id);
        
        JToolBarHelper::title(JText::_('Provinces Management'), 'banners.png');

        if ($canDo->get('core.create')){
           JToolBarHelper::addNew('province.add','JTOOLBAR_NEW');
        }
        
        if ($canDo->get('core.edit')) 
           JToolBarHelper::editList('province.edit','JTOOLBAR_EDIT');
        

        if ($canDo->get('core.edit.state')){
            if ($this->state->get('filter.state') != 2){
                JToolBarHelper::divider();
                JToolBarHelper::custom('provinces.publish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);
                JToolBarHelper::custom('provinces.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
            }
        }

        JToolBarHelper::deleteList('', 'provinces.delete','JTOOLBAR_EMPTY_TRASH');
              
        if ($canDo->get('core.admin')){
            JToolBarHelper::preferences('com_iks');
            JToolBarHelper::divider();
        }
        
        JToolBarHelper::help('IKS Help');
    }
}
