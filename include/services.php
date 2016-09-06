<?php

global $smarty;
global $hostgroups;
global $servicegroups;
global $services, $services_all, $services_ok, $services_critical, $services_warning, $services_unknown, $services_pending;
global $services_critical_unhandled, $services_critical_disabled, $services_critical_acknowledged, $services_critical_scheduled, $services_critical_hostdown;
global $services_warning_unhandled, $services_warning_disabled, $services_warning_acknowledged, $services_warning_scheduled, $services_warning_hostdown;
global $services_unknown_unhandled, $services_unknown_disabled, $services_unknown_acknowledged, $services_unknown_scheduled, $services_unknown_hostdown;
global $services_ok_disabled, $services_ok_scheduled;

$services = array();

if (empty($hostgroups) && empty($servicegroups)) {
    $services = readServices();
} elseif (empty($servicegroups)) {
    $services = readServicesByHostgroup($hostgroups);
} else {
    $services = readServicesByServicegroup($servicegroups);
}

$services_all = array();
$services_ok = array();
$services_critical = array();
$services_warning = array();
$services_unknown = array();
$services_pending = array();
$services_critical_unhandled = array();
$services_critical_disabled = array();
$services_critical_acknowledged = array();
$services_critical_scheduled = array();
$services_critical_hostdown = array();
$services_warning_unhandled = array();
$services_warning_disabled = array();
$services_warning_acknowledged = array();
$services_warning_scheduled = array();
$services_warning_hostdown = array();
$services_unknown_unhandled = array();
$services_unknown_disabled = array();
$services_unknown_acknowledged = array();
$services_unknown_scheduled = array();
$services_unknown_hostdown = array();
$services_ok_disabled = array();
$services_ok_scheduled = array();

foreach ($services as &$s) {

    $name = $s['name1']."_".$s['name2'];
    /* */
    if ( $s['has_been_checked'] == "0" ) $services_pending["$name"] = $s;
    else if ( $s['state_type'] == "0" ) { $s['current_status'] = "OK"; $services_ok["$name"] = $s; }
    else if ( $s['current_state'] == "0" ) { $s['current_status'] = "OK"; $services_ok["$name"] = $s; }
    else if ( $s['current_state'] == "1" ) { $s['current_status'] = "Warning"; $services_warning["$name"] = $s; }
    else if ( $s['current_state'] == "2" ) { $s['current_status'] = "Critical"; $services_critical["$name"] = $s; }
    else if ( $s['current_state'] == "3" ) { $s['current_status'] = "Unknown"; $services_unknown["$name"] = $s; }
    $services_all["$name"] = $s;    
}

foreach ($services_unknown as &$s) {
    $handled=0;
    $name = $s['name1']."_".$s['name2'];
    if ( isset($hosts_down[$s['name1']]) ) { $handled=1 ; $services_unknown_hostdown["$name"] = $s; }
    if ( isset($hosts_unreachable[$s['name1']]) ) { $handled=1 ; $services_unknown_hostdown["$name"] = $s; }
    if ( $s['active_checks_enabled'] == "0") { $handled=1 ; $services_unknown_disabled["$name"] = $s; }
    if ( $s['problem_has_been_acknowledged'] == "1") { $handled=1 ; $services_unknown_acknowledged["$name"] = $s; }
    if ( $s['scheduled_downtime_depth'] == "1") { $handled=1 ; $services_unknown_scheduled["$name"] = $s; }
    if ($handled == 0) $services_unknown_unhandled["$name"] = $s; 
}
foreach ($services_critical as &$s) {
    $handled=0;
    $name = $s['name1']."_".$s['name2'];
    if ( isset($hosts_down[$s['name1']]) ) { $handled=1 ; $services_critical_hostdown["$name"] = $s; }
    if ( isset($hosts_unreachable[$s['name1']]) ) { $handled=1 ; $services_critical_hostdown["$name"] = $s; }
    if ( $s['active_checks_enabled'] == "0") { $handled=1 ; $services_critical_disabled["$name"] = $s; }
    if ( $s['problem_has_been_acknowledged'] == "1") { $handled=1 ; $services_critical_acknowledged["$name"] = $s; }
    if ( $s['scheduled_downtime_depth'] == "1") { $handled=1 ; $services_critical_scheduled["$name"] = $s; }
    if ($handled == 0) $services_critical_unhandled["$name"] = $s; 
}
foreach ($services_warning as &$s) {
    $handled=0;
    $name = $s['name1']."_".$s['name2'];
    if ( isset($hosts_down[$s['name1']]) ) { $handled=1 ; $services_warning_hostdown["$name"] = $s; }
    if ( isset($hosts_unreachable[$s['name1']]) ) { $handled=1 ; $services_warning_hostdown["$name"] = $s; }
    if ( $s['active_checks_enabled'] == "0") { $handled=1 ; $services_warning_disabled["$name"] = $s; }
    if ( $s['problem_has_been_acknowledged'] == "1") { $handled=1 ; $services_warning_acknowledged["$name"] = $s; }
    if ( $s['scheduled_downtime_depth'] == "1") { $handled=1 ; $services_warning_scheduled["$name"] = $s; }
    if ($handled == 0) $services_warning_unhandled["$name"] = $s; 
}
foreach ($services_ok as &$s) {
    $name = $s['name1']."_".$s['name2'];
    if ( $s['active_checks_enabled'] == "0") $services_ok_disabled["$name"] = $s; 
    if ( $s['scheduled_downtime_depth'] == "1") $services_ok_scheduled["$name"] = $s; 
}


$smarty->assign ("services", $services_all);
$smarty->assign ("services_ok", $services_ok);
$smarty->assign ("services_warning", $services_warning);
$smarty->assign ("services_critical", $services_critical);
$smarty->assign ("services_unknown", $services_unknown);
$smarty->assign ("services_pending", $services_pending);

$smarty->assign ("services_critical_unhandled", $services_critical_unhandled);
$smarty->assign ("services_critical_disabled", $services_critical_disabled);
$smarty->assign ("services_critical_acknowledged", $services_critical_acknowledged);
$smarty->assign ("services_critical_scheduled", $services_critical_scheduled);
$smarty->assign ("services_critical_hostdown", $services_critical_hostdown);

$smarty->assign ("services_warning_unhandled", $services_warning_unhandled);
$smarty->assign ("services_warning_disabled", $services_warning_disabled);
$smarty->assign ("services_warning_acknowledged", $services_warning_acknowledged);
$smarty->assign ("services_warning_scheduled", $services_warning_scheduled);
$smarty->assign ("services_warning_hostdown", $services_warning_hostdown);

$smarty->assign ("services_unknown_unhandled", $services_unknown_unhandled);
$smarty->assign ("services_unknown_disabled", $services_unknown_disabled);
$smarty->assign ("services_unknown_acknowledged", $services_unknown_acknowledged);
$smarty->assign ("services_unknown_scheduled", $services_unknown_scheduled);
$smarty->assign ("services_unknown_hostdown", $services_unknown_hostdown);

$smarty->assign ("services_ok_disabled", $services_ok_disabled);
$smarty->assign ("services_ok_scheduled", $services_ok_scheduled);

?>
