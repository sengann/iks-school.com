<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.database.table');
class IKSTableSupporter extends JTable
{
    var $id=null;
    var $name= null;
    var $Title = null;
    var $email= null;
    var $address= null;
    var $city= null;
    var $country= null;
    var $donate= null;
    var $description= null;
    var $state= null;    
    var $checked_out= null;
    var $checked_out_time= null;

    function __construct(&$db)
    {
            parent::__construct('#__iks_supporter', 'id', $db);
    }

}

