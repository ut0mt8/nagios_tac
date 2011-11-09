<?php

global $hostgroups;
$hostgroups = array( "Group1", "Group2" );

require_once('include/bootstrap.php');
require_once('include/hosts.php');
require_once('include/services.php');
require_once('include/history.php');
require_once('include/actions.php');

/* Make the tactical page */
$smarty->display('header.tpl');

$smarty->assign ("table", $hosts);
$smarty->assign ("id", "select_hosts");
$smarty->display('select_hosts.tpl');

$smarty->display('hosts.tpl');
$smarty->display('services.tpl');

$smarty->assign ("title", "Unhandled Hosts problems");
$smarty->assign ("id", "hosts_down_problem");
$smarty->display('table_hosts_problem.tpl');

$smarty->assign ("title", "Unhandled Services problems");
$smarty->assign ("id", "services_problem");
$smarty->display('table_services_problem.tpl');

print "<hr>";

$smarty->assign ("id", "history");
$smarty->display('history.tpl');

/* -- -- */
$smarty->display('footer.tpl');

?>
