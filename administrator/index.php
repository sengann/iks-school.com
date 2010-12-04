<?php
/**
 * @version		$Id: index.php 18650 2010-08-26 13:28:49Z ian $
 * @package		Joomla.Administrator
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// Set flag that this is a parent file
define('_JEXEC', 1);
ini_set('display_errors',1);
define("CH_DEBUG",1);
function ch_debug($var,$exit=false,$configable=true)
 {
	if(CH_DEBUG  || $exit==true)
	{
		$debug_traces=debug_backtrace();
		$style='';
		echo "<div style='text-align:left;border-top:1px solid #ccc;background-color:white;color:black;overflow:auto;' > "  ;
		echo "<pre>";
		//foreach($debug_traces as $debug_trace)
		$debug_trace=$debug_traces[0];
		{
			echo "<br /> <strong> Line: </strong> {$debug_trace['line']} ";
			echo "<strong>  File: </strong>  {$debug_trace['file']}";
			echo "<br />";

			print_r($debug_trace['args'][0]);//print_r($var);
		}
		echo "</pre>";
		echo "</div>";
        if($exit==true)
          exit;
	}
 }


define('JPATH_BASE', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);

require_once JPATH_BASE.DS.'includes'.DS.'defines.php';
require_once JPATH_BASE.DS.'includes'.DS.'framework.php';
require_once JPATH_BASE.DS.'includes'.DS.'helper.php';
require_once JPATH_BASE.DS.'includes'.DS.'toolbar.php';

// Mark afterLoad in the profiler.
JDEBUG ? $_PROFILER->mark('afterLoad') : null;

// Instantiate the application.
$app = JFactory::getApplication('administrator');

// Initialise the application.
$app->initialise(array(
	'language' => $app->getUserState('application.lang', 'lang')
));

// Mark afterIntialise in the profiler.
JDEBUG ? $_PROFILER->mark('afterInitialise') : null;

// Route the application.
$app->route();

// Mark afterRoute in the profiler.
JDEBUG ? $_PROFILER->mark('afterRoute') : null;

// Dispatch the application.
$app->dispatch();

// Mark afterDispatch in the profiler.
JDEBUG ? $_PROFILER->mark('afterDispatch') : null;

// Render the application.
$app->render();

// Mark afterRender in the profiler.
JDEBUG ? $_PROFILER->mark('afterRender') : null;

// Return the response.
echo $app;