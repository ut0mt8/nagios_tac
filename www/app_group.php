<?php

global $servicegroups;
$servicegroups = array( "App1", "App2" );

require_once('include/bootstrap.php');
require_once('include/hosts.php');
require_once('include/services.php');
require_once('include/actions.php');

/* Make the tactical page */
$smarty->display('header.tpl');
$smarty->display('services.tpl');

$smarty->assign ("title", "Unhandled Applications problems");
$smarty->assign ("id", "services_problem");
$smarty->display('table_services_problem.tpl');

/* -- -- */
$smarty->display('footer.tpl');

?>
