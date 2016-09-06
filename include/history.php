<?php

global $smarty;
global $hostgroups;
global $history, $service_history;

if (empty($hostgroups)) {
    $history = readHistory();
} else {
    $history = readHistoryByHostgroup($hostgroups);
}

$service_history = array();

foreach ($history as $s) {

    if ( $s['objecttype_id'] == "SERVICE ALERT" || $s['objecttype_id'] == "2" ) { 
        if ( $s['state'] == 0 ) { $s['status'] = "OK"; }
        if ( $s['state'] == 1 ) { $s['status'] = "Warning"; }
        if ( $s['state'] == 2 ) { $s['status'] = "Critical"; }
        if ( $s['state'] == 3 ) { $s['status'] = "Unknown"; }
    }
    // $s['objecttype_id'] == "HOST ALERT"  
    else { 
        $s['name2'] = "HOST";
        if ( $s['state'] == 0 ) { $s['status'] = "UP"; }
        if ( $s['state'] == 1 ) { $s['status'] = "DOWN"; }
        if ( $s['state'] == 2 ) { $s['status'] = "Unreachable"; }
    }
    array_push ($service_history, $s);
}

$smarty->assign ("history", $service_history);

?>
