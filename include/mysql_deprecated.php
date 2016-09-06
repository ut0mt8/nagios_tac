<?php

global $db_host, $db_user, $db_pass, $db_pass, $conn;

$conn = mysql_connect ($db_host, $db_user, $db_pass) OR DIE ("Can't connect to database");
@mysql_select_db ($db_data, $conn);


function readHosts() {
    global $conn;
    $hosts = array();

    $query = "SELECT * FROM nagios_objects,nagios_hoststatus where host_object_id=object_id and is_active = 1 order by nagios_objects.name1";
    $result = mysql_query ($query, $conn);

    if (mysql_num_rows ($result) >= 1) {
        $hosts = array();
        while ($rows = mysql_fetch_array ($result, MYSQL_ASSOC)) 
            array_push ($hosts, $rows);
    }
    return $hosts;
}

function readHostsByGroup($hostgroups) {
    global $conn;
    $hosts = array();

    $query = "SELECT o.*, hs.*, hg.alias FROM nagios_objects o, nagios_hoststatus hs,nagios_hostgroup_members hgm, nagios_hostgroups hg where hs.host_object_id=o.object_id and o.object_id=hgm.host_object_id and hg.hostgroup_id=hgm.hostgroup_id and is_active = 1 order by o.name1";
    $result = mysql_query ($query, $conn);

    if (mysql_num_rows ($result) >= 1) {
        $hosts = array();
        while ($rows = mysql_fetch_array ($result, MYSQL_ASSOC)) {
            if (in_array($rows['alias'],$hostgroups)) {
                array_push ($hosts, $rows);
            }
        }
    }
    return $hosts;
}

function readServices() {
    global $conn;
    $services = array();

    $query = "SELECT * FROM nagios_objects,nagios_servicestatus where service_object_id=object_id and is_active = 1 order by nagios_objects.name1,nagios_objects.name2";
    $result = mysql_query ($query, $conn);

    if (mysql_num_rows ($result) >= 1) {
        $services = array();
        while ($rows = mysql_fetch_array ($result, MYSQL_ASSOC)) 
            array_push ($services, $rows);
    }
    return $services;
}

function readServicesByHostgroup($hostgroups) {
    global $conn;
    $services = array();

    $query = "SELECT so.*, s.*, hg.alias FROM nagios_objects ho, nagios_objects so, nagios_servicestatus s, nagios_hostgroup_members hgm, nagios_hostgroups hg where s.service_object_id=so.object_id and  ho.object_id=hgm.host_object_id and hg.hostgroup_id=hgm.hostgroup_id and so.name1=ho.name1 and ho.is_active = 1 order by so.name1,so.name2";
    $result = mysql_query ($query, $conn);

    if (mysql_num_rows ($result) >= 1) {
        $services = array();
        while ($rows = mysql_fetch_array ($result, MYSQL_ASSOC)) {
            if (in_array($rows['alias'],$hostgroups)) {
                array_push ($services, $rows);
            }
        }
    }
    return $services;
}

function readHistory() {
    global $conn, $history_size_limit, $history_time_limit;
    $history = array();

    $query = " select * from nagios_statehistory, nagios_objects where nagios_statehistory.object_id=nagios_objects.object_id and state > 0 and state_type=1 and state_time > date_sub(now(), interval $history_time_limit second) order by state_time desc limit $history_size_limit";
    $result = mysql_query ($query, $conn);

    if (mysql_num_rows ($result) >= 1) {
        $history = array();
        while ($rows = mysql_fetch_array ($result, MYSQL_ASSOC))
            array_push ($history, $rows);
    }
    return $history;
}

function readHistoryByHostgroup($hostgroups) {
    global $conn, $history_size_limit, $history_time_limit;
    $history = array();

    $query = "select sh.*, o.*, hg.alias from nagios_statehistory sh, nagios_objects o, nagios_objects ho, nagios_hostgroup_members hgm, nagios_hostgroups hg where sh.object_id=o.object_id  and ho.object_id=hgm.host_object_id and hg.hostgroup_id=hgm.hostgroup_id and o.name1=ho.name1 and state > 0 and state_type=1 and state_time > date_sub(now(), interval $history_time_limit second) order by state_time desc limit $history_time_limit";
    $result = mysql_query ($query, $conn);

    if (mysql_num_rows ($result) >= 1) {
        $history = array();
        while ($rows = mysql_fetch_array ($result, MYSQL_ASSOC)) {
            if (in_array($rows['alias'],$hostgroups)) {
                array_push ($history, $rows);
            }
        }
    }
    return $history;
}
