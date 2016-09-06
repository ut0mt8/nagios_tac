<?php

global $smarty;
global $hostgroups;
global $hosts, $hosts_all, $hosts_up, $hosts_down, $hosts_pending, $hosts_unreachable, $hosts_down_unhandled;
global $hosts_down_disabled, $hosts_down_acknowledged, $hosts_down_scheduled, $hosts_up_disabled, $hosts_up_scheduled, $hosts_unreachable;

$hosts = array();

if (empty($hostgroups)) {
    $hosts = readHosts();
} else {
    $hosts = readHostsByGroup($hostgroups);
}

$hosts_all = array();
$hosts_up = array();
$hosts_down = array();
$hosts_pending = array();
$hosts_unreachable = array();
$hosts_down_unhandled = array();
$hosts_down_disabled = array();
$hosts_down_acknowledged = array();
$hosts_down_scheduled = array();
$hosts_up_disabled = array();
$hosts_up_scheduled = array();
$hosts_unreachable = array();
    
foreach ($hosts as &$h) {
    $name = $h['name1'];
    if ( $h['has_been_checked'] == "0" ) $hosts_pending["$name"] = $h;
    if ( $h['state_type'] == "0" ) { $h['current_status'] = "Up"; $hosts_up["$name"] = $h; }
    else if ( $h['current_state'] == "0" ) { $h['current_status'] = "Up"; $hosts_up["$name"] = $h; }
    else if ( $h['current_state'] == "1" ) { $h['current_status'] = "Down"; $hosts_down["$name"] = $h; }
    else if ( $h['current_state'] == "2" ) { $h['current_status'] = "Unreachable"; $hosts_unreachable["$name"] = $h; }
    $hosts_all["$name"] = $h;
}

foreach ($hosts_down as &$h) {
    $handled=0;
    $name = $h['name1'];
    if ( $h['active_checks_enabled'] == "0") { $handled=1 ; $hosts_down_disabled["$name"] = $h; }
    if ( $h['problem_has_been_acknowledged'] == "1") { $handled=1 ; $hosts_down_acknowledged["$name"] =  $h; }
    if ( $h['scheduled_downtime_depth'] == "1") { $handled=1 ; $hosts_down_scheduled["$name"] = $h; }
    if ( $handled == 0) { $hosts_down_unhandled["$name"] = $h; }
}

foreach ($hosts_up as &$h) {
    $name = $h['name1'];
    if ( $h['active_checks_enabled'] == "0") { $hosts_up_disabled["$name"] = $h; }
    if ( $h['scheduled_downtime_depth'] == "1") { $hosts_up_scheduled["$name"] = $h; }
}

$smarty->assign ("hosts", $hosts_all);
$smarty->assign ("hosts_up", $hosts_up);
$smarty->assign ("hosts_down", $hosts_down);
$smarty->assign ("hosts_pending", $hosts_pending);
$smarty->assign ("hosts_unreachable", $hosts_unreachable);

$smarty->assign ("hosts_down_unhandled", $hosts_down_unhandled);
$smarty->assign ("hosts_down_acknowledged", $hosts_down_acknowledged);
$smarty->assign ("hosts_down_disabled", $hosts_down_disabled);
$smarty->assign ("hosts_down_scheduled", $hosts_down_scheduled);

$smarty->assign ("hosts_up_disabled", $hosts_up_disabled);
$smarty->assign ("hosts_up_scheduled", $hosts_up_scheduled);

?>
