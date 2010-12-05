<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class IKSModelProvinces extends JModelList
{

    protected function getListQuery()
    {
        $db	= $this->getDbo();
        $query	= $db->getQuery(true);
        $query->select(
                'a.*'
        );
        $query->from('`#__iks_province` AS a');
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0)
                $query->where('a.id = '.(int) substr($search, 3));
            else {
                $search = $db->Quote('%'.$db->getEscaped($search, true).'%');
                $query->where('(a.ref LIKE '.$search.')');
            }
        }
        return $query;
    }
    protected function getStoreId($id = '')
    {
        // Compile the store id.
        $id	.= ':'.$this->getState('filter.search');
        $id	.= ':'.$this->getState('filter.access');
        $id	.= ':'.$this->getState('filter.state');
        $id	.= ':'.$this->getState('filter.id');
        return parent::getStoreId($id);
    }
}