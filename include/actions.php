<?php

/* AJAX function */

function nagios_cmd() {
    if (isset($_GET['host'])) $action = $_GET['action'];
    else return;

    if (isset($_GET['host'])) $host = $_GET['host'];
    if (isset($_GET['service'])) $service = $_GET['service'];

    $now=time();

    switch ($action) {
    case 'ack_service':
        $commandstring="[$now] ACKNOWLEDGE_SVC_PROBLEM;$host;$service;1;1;1;nagiosadmin;Ack_Via_NagiosNG";
        sendLiveCommand($commandstring);
        echo "Acknowledge service problem $host/$service.";
        break;
    case 'dis_service':
        $commandstring="[$now] DISABLE_SVC_CHECK;$host;$service";
        sendLiveCommand($commandstring);
        echo "Disable service $host/$service.";
        break;
    case 'en_service':
        $commandstring="[$now] ENABLE_SVC_CHECK;$host;$service";
        sendLiveCommand($commandstring);
        echo "Enable service $host/$service.";
        break;
    case 'ok_service':
        $commandstring="[$now] PROCESS_SERVICE_CHECK_RESULT;$host;$service;0;Reinit_OK";
        sendLiveCommand($commandstring);
        echo "Reinit OK service $host/$service.";
        break;
    case 'rsched_service':
        $commandstring="[$now] SCHEDULE_SVC_CHECK;$host;$service;$now";
        sendLiveCommand($commandstring);
        echo "Reschedule service $host/$service.";
        break;
    case 'ack_host':
        $commandstring="[$now] ACKNOWLEDGE_HOST_PROBLEM;$host;1;1;1;nagiosadmin;Ack_Via_NagiosNG";
        sendLiveCommand($commandstring);
        echo "Acknowledge host problem $host.";
        break;
    case 'dis_host':
        $commandstring="[$now] DISABLE_HOST_CHECK;$host";
        sendLiveCommand($commandstring);
        echo "Disable host $host.";
        break;
    case 'en_host':
        $commandstring="[$now] ENABLE_HOST_CHECK;$host";
        sendLiveCommand($commandstring);
        echo "Enable host $host.";
        break;
    case 'rsched_host':
        $commandstring="[$now] SCHEDULE_HOST_CHECK;$host;$now";
        sendLiveCommand($commandstring);
        echo "Enable host $host.";
        break;
    default:
        echo "Unknown command [$action] to send...";
    }
}


function display_table_hosts() {
    global $smarty;
    global $hosts_down_acknowledged;
    global $hosts_down_unhandled;
    global $hosts_down_scheduled;
    global $hosts_down_disabled;
    global $hosts_down;
    global $hosts_up;
    global $hosts_pending;
    global $hosts_unreachable;

    $view = $_GET['view'];

    switch ($view) {
        case 'hosts_problems':
            $smarty->assign ("title", "Unhandled Hosts problems");
            $smarty->assign ("id", "hosts_down_problem");
            $smarty->display('table_hosts_problem.tpl');
            break;
        case 'hosts_down_acknowledged':
            $smarty->assign ("title", "Acknowledged Hosts Down");
            $smarty->assign ("class", "hosts_down_ok");
            $smarty->assign ("id", "hosts_down_acknowledged");
            $smarty->assign ("table", $hosts_down_acknowledged);
            $smarty->display('table_hosts.tpl');
            break;
        case 'hosts_down_unhandled':
            $smarty->assign ("title", "Unhandled Hosts Down");
            $smarty->assign ("class", "hosts_down");
            $smarty->assign ("id", "hosts_down_unhandled");
            $smarty->assign ("table", $hosts_down_unhandled);
            $smarty->display('table_hosts.tpl');
            break;
        case 'hosts_down_scheduled':
            $smarty->assign ("title", "Scheduled Hosts Down");
            $smarty->assign ("class", "hosts_down_ok");
            $smarty->assign ("id", "hosts_down_scheduled");
            $smarty->assign ("table", $hosts_down_scheduled);
            $smarty->display('table_hosts.tpl');
            break;
        case 'hosts_down_disabled':
            $smarty->assign ("title", "Disabled Hosts Down");
            $smarty->assign ("class", "hosts_down_ok");
            $smarty->assign ("id", "hosts_down_disabled");
            $smarty->assign ("table", $hosts_down_disabled);
            $smarty->display('table_hosts.tpl');
            break;
        case 'hosts_down':
            $smarty->assign ("title", "Hosts Down");
            $smarty->assign ("class", "hosts_down");
            $smarty->assign ("id", "hosts_down");
            $smarty->assign ("table", $hosts_down);
            $smarty->display('table_hosts.tpl');
            break;
        case 'hosts_up':
            $smarty->assign ("title", "Hosts Up");
            $smarty->assign ("class", "hosts_up");
            $smarty->assign ("id", "hosts_up");
            $smarty->assign ("table", $hosts_up);
            $smarty->display('table_hosts.tpl');
            break;
        case 'hosts_pending':
            $smarty->assign ("title", "Hosts Pending");
            $smarty->assign ("class", "hosts_pending");
            $smarty->assign ("id", "hosts_pending");
            $smarty->assign ("table", $hosts_pending);
            $smarty->display('table_hosts.tpl');
            break;
        case 'hosts_unreachable':
            $smarty->assign ("title", "Host Unreachable");
            $smarty->assign ("class", "hosts_unreachable");
            $smarty->assign ("id", "hosts_unreachable");
            $smarty->assign ("table", $hosts_unreachable);
            $smarty->display('table_hosts.tpl');
            break;
        default:
            break;
    }
}


function display_table_services() {
    global $smarty;
    global $services;
    global $services_ok;
    global $services_warning;
    global $services_critical;
    global $services_unknown;
    global $services_pending;
    global $services_critical_unhandled;
    global $services_critical_disabled;
    global $services_critical_acknowledged;
    global $services_critical_scheduled;
    global $services_critical_hostdown;
    global $services_warning_unhandled;
    global $services_warning_disabled;
    global $services_warning_acknowledged;
    global $services_warning_scheduled;
    global $services_warning_hostdown;
    global $services_unknown_unhandled;
    global $services_unknown_disabled;
    global $services_unknown_acknowledged;
    global $services_unknown_scheduled;
    global $services_unknown_hostdown;
    global $services_ok_disabled;
    global $services_ok_scheduled;

    $view = $_GET['view'];

    switch ($view) {
        case 'services_critical_acknowledged':
            $smarty->assign ("title", "Acknowledged Services Critical");
            $smarty->assign ("class", "services_nok_ok");
            $smarty->assign ("id", "services_critical_acknowledged");
            $smarty->assign ("table", $services_critical_acknowledged);
            $smarty->display('table_services.tpl');
            break;
        case 'services_critical_unhandled':
            $smarty->assign ("title", "Unhandled Services Critical");
            $smarty->assign ("class", "services_nok");
            $smarty->assign ("id", "services_critical_unhandled");
            $smarty->assign ("table", $services_critical_unhandled);
            $smarty->display('table_services.tpl');
            break;
        case 'services_critical_scheduled':
            $smarty->assign ("title", "Scheduled Services Critical");
            $smarty->assign ("class", "services_nok_ok");
            $smarty->assign ("id", "services_critical_scheduled");
            $smarty->assign ("table", $services_critical_scheduled);
            $smarty->display('table_services.tpl');
            break;
        case 'services_critical_disabled':
            $smarty->assign ("title", "Disabled Services Critical");
            $smarty->assign ("class", "services_nok_ok");
            $smarty->assign ("id", "services_critical_disabled");
            $smarty->assign ("table", $services_critical_disabled);
            $smarty->display('table_services.tpl');
            break;
        case 'services_critical_hostdown':
            $smarty->assign ("title", "Services Critical on Problem Hosts");
            $smarty->assign ("class", "services_nok_ok");
            $smarty->assign ("id", "services_critical_hostdown");
            $smarty->assign ("table", $services_critical_hostdown);
            $smarty->display('table_services.tpl');
            break;
        case 'services_critical':
            $smarty->assign ("title", "Services Critical");
            $smarty->assign ("class", "services_nok");
            $smarty->assign ("id", "services_critical");
            $smarty->assign ("table", $services_critical);
            $smarty->display('table_services.tpl');
            break;
        case 'services_warning_acknowledged':
            $smarty->assign ("title", "Acknowledged Services Warning");
            $smarty->assign ("class", "services_nok_ok");
            $smarty->assign ("id", "services_warning_acknowledged");
            $smarty->assign ("table", $services_warning_acknowledged);
            $smarty->display('table_services.tpl');
            break;
        case 'services_warning_unhandled':
            $smarty->assign ("title", "Unhandled Services Warning");
            $smarty->assign ("class", "services_warning");
            $smarty->assign ("id", "services_warning_unhandled");
            $smarty->assign ("table", $services_warning_unhandled);
            $smarty->display('table_services.tpl');
            break;
        case 'services_warning_scheduled':
            $smarty->assign ("title", "Scheduled Services Warning");
            $smarty->assign ("class", "services_nok_ok");
            $smarty->assign ("id", "services_warning_scheduled");
            $smarty->assign ("table", $services_warning_scheduled);
            $smarty->display('table_services.tpl');
            break;
        case 'services_warning_disabled':
            $smarty->assign ("title", "Disabled Services Warning");
            $smarty->assign ("class", "services_nok_ok");
            $smarty->assign ("id", "services_warning_disabled");
            $smarty->assign ("table", $services_warning_disabled);
            $smarty->display('table_services.tpl');
            break;
        case 'services_warning_hostdown':
            $smarty->assign ("title", "Services Warning on Problem Hosts");
            $smarty->assign ("class", "services_nok_ok");
            $smarty->assign ("id", "services_warning_hostdown");
            $smarty->assign ("table", $services_warning_hostdown);
            $smarty->display('table_services.tpl');
            break;
        case 'services_warning':
            $smarty->assign ("title", "Services Warning");
            $smarty->assign ("class", "services_warning");
            $smarty->assign ("id", "services_warning");
            $smarty->assign ("table", $services_warning);
            $smarty->display('table_services.tpl');
            break;
        case 'services_unknown_acknowledged':
            $smarty->assign ("title", "Acknowledged Services Unknown");
            $smarty->assign ("class", "services_nok_ok");
            $smarty->assign ("id", "services_unknown_acknowledged");
            $smarty->assign ("table", $services_unknown_acknowledged);
            $smarty->display('table_services.tpl');
            break;
        case 'services_unknown_unhandled':
            $smarty->assign ("title", "Unhandled Services Unknown");
            $smarty->assign ("class", "services_unknown");
            $smarty->assign ("id", "services_unknown_unhandled");
            $smarty->assign ("table", $services_unknown_unhandled);
            $smarty->display('table_services.tpl');
            break;
        case 'services_unknown_scheduled':
            $smarty->assign ("title", "Scheduled Services Unknown");
            $smarty->assign ("class", "services_nok_ok");
            $smarty->assign ("id", "services_unknown_scheduled");
            $smarty->assign ("table", $services_unknown_scheduled);
            $smarty->display('table_services.tpl');
            break;
        case 'services_unknown_disabled':
            $smarty->assign ("title", "Disabled Services Unknown");
            $smarty->assign ("class", "services_nok_ok");
            $smarty->assign ("id", "services_unknown_disabled");
            $smarty->assign ("table", $services_unknown_disabled);
            $smarty->display('table_services.tpl');
            break;
        case 'services_unknown_hostdown':
            $smarty->assign ("title", "Services Unknown on Problem Hosts");
            $smarty->assign ("class", "services_nok_ok");
            $smarty->assign ("id", "services_unknown_hostdown");
            $smarty->assign ("table", $services_unknown_hostdown);
            $smarty->display('table_services.tpl');
            break;
        case 'services_unknown':
            $smarty->assign ("title", "Services Unknown");
            $smarty->assign ("class", "services_unknown");
            $smarty->assign ("id", "services_unknown");
            $smarty->assign ("table", $services_unknown);
            $smarty->display('table_services.tpl');
            break;
        case 'services_ok':
            $smarty->assign ("title", "Services OK");
            $smarty->assign ("class", "services_ok");
            $smarty->assign ("id", "services_ok");
            $smarty->assign ("table", $services_ok);
            $smarty->display('table_services.tpl');
            break;
        case 'services_pending':
            $smarty->assign ("title", "Services Pending");
            $smarty->assign ("class", "services_pending");
            $smarty->assign ("id", "services_pending");
            $smarty->assign ("table", $services_pending);
            $smarty->display('table_services.tpl');
        default:
            break;
    }
}


function display_table_services_count() {
    global $smarty;
    global $services;
    global $services_ok;
    global $services_warning;
    global $services_critical;
    global $services_unknown;
    global $services_pending;
    global $services_critical_unhandled;
    global $services_critical_disabled;
    global $services_critical_acknowledged;
    global $services_critical_scheduled;
    global $services_critical_hostdown;
    global $services_warning_unhandled;
    global $services_warning_disabled;
    global $services_warning_acknowledged;
    global $services_warning_scheduled;
    global $services_warning_hostdown;
    global $services_unknown_unhandled;
    global $services_unknown_disabled;
    global $services_unknown_acknowledged;
    global $services_unknown_scheduled;
    global $services_unknown_hostdown;
    global $services_ok_disabled;
    global $services_ok_scheduled;

    $smarty->display('services.tpl');
}

function display_table_services_host() {
    global $smarty;
    global $services_all;

    $host = $_GET['host'];
    
    if ($host == "all") {
        $smarty->assign ("title", "Unhandled Services problems");
        $smarty->assign ("id", "services_problem");
        $smarty->display('table_services_problem.tpl');
    }
    else {
        $service_host = array();

        foreach ($services_all as $s) {
        
            if ( $s['name1'] == "$host") { 
                if ( $s['current_state'] == "0" ) { $s['current_status'] = "OK"; }
                else if ( $s['current_state'] == "1" ) { $s['current_status'] = "Warning"; }
                else if ( $s['current_state'] == "2" ) { $s['current_status'] = "Critical"; }
                else if ( $s['current_state'] == "3" ) { $s['current_status'] = "Unknown"; }
                    array_push ($service_host, $s); 
            }

        }

        $smarty->assign ("title", "All Services for $host");
        $smarty->assign ("id", "services_host");
        $smarty->assign ("table", $service_host);
        $smarty->display('table_services_host.tpl');
    }
}

/* -- -- */
ajax_register('nagios_cmd');
ajax_register('display_table_hosts');
ajax_register('display_table_services');
ajax_register('display_table_services_count');
ajax_register('display_table_services_host');
ajax_process_call();
/* -- -- */

?>
