<?php

function subval_sort($a,$subkey) {
    if ($a) {
        foreach($a as $k=>$v) {
            $b[$k] = $v[$subkey];
        }
        asort($b);
        foreach($b as $key=>$val) {
            $c[] = $a[$key];
        }
        return $c;
    } else {
        return null;
    }
}

function subval_sort_multi($a,$subkey,$subkey2) {
    if ($a) {
        foreach($a as $k=>$v) {
            $b[$k] = array ($v[$subkey] , $v[$subkey2] );
        }
        asort($b);
        foreach($b as $key=>$val) {
            $c[] = $a[$key];
        }
        return $c;
    } else {
        return null;
    }
}

function readSocket($len,$socket) {
    $offset = 0;
    $socketData = '';

    while($offset < $len) {
        if(($data = @socket_read($socket, $len-$offset)) == false) {
            return false;
        }

        $dataLen = strlen ($data);
        $offset += $dataLen;
        $socketData .= $data;

        if($dataLen == 0) {
            break;
        }
    }
    return $socketData;
}

function readLiveData($request) {
    global $livestatus_socket;
    global $livestatus_address;
    global $livestatus_port;

    if ($livestatus_socket != "") {
        $live_socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        if ( socket_connect($live_socket, $livestatus_socket) == false ) { 
            die("Socket connect error\n");
        }
    } else {
        $live_socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ( socket_connect($live_socket, $livestatus_address, $livestatus_port) == false ) { 
            die("Socket connect error\n");
        }
    }

    socket_write($live_socket, $request);

    // Read 16 bytes to get the status code and body sie
    $read = readSocket(16,$live_socket);

    // Catch problem while reading
    if($read == false) {
        die("Read header error\n");
    }

    // Extract status code
    $status = substr($read, 0, 3);

    // Extract content length
    $len = intval(trim(substr($read, 4, 11)));

    // Read socket until end of data
    $read = readSocket($len,$live_socket);

    // Catch problem while reading
    if($read == false) {
        die("Read data error\n");
    }

    // Catch errors (Like HTTP 200 is OK)
    if($status != "200") {
        die("Status error : $status $read \n");
    }

    // Catch problems occured while reading? 104: Connection reset by peer
    if(socket_last_error($live_socket) == 104) {
        die("Reading error\n");
    }

    return $read;
}

function sendLiveData($request) {
    global $livestatus_socket;
    global $livestatus_address;
    global $livestatus_port;

    if ($livestatus_socket != "") {
        $live_socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        if ( socket_connect($live_socket, $livestatus_socket) == false ) { 
            die("Socket connect error\n");
        }
    } else {
        $live_socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ( socket_connect($live_socket, $livestatus_address, $livestatus_port) == false ) { 
            die("Socket connect error\n");
        }
    }

    socket_write($live_socket, $request);
}

function sendLiveCommand($request) {
    sendLiveData("COMMAND ".$request."\n\n");
}

function readLiveJson($request) {

    $read = readLiveData($request."\nOutputFormat: json\nResponseHeader: fixed16\n\n");

    $json = json_decode($read, false); 
    return $json;
}

function readLiveCsv($request) {

    $read = readLiveData($request."\nSeparators: 10 35 44 124\nResponseHeader: fixed16\n\n");

    $delimiter = "#";
    $lines = explode("\n", $read);

    $field_names = explode($delimiter, array_shift($lines));
    foreach ($lines as $line) {
        if (empty($line)) continue;
        $fields = explode($delimiter, $line);
        $_res = array();
        foreach ($field_names as $key => $f) {
            $_res[$f] = $fields[$key];
        }
        $res[] = $_res;
    }
    return $res;
}

function readHosts() {

    $read = readLiveData(    "GET hosts\n".
                "OutputFormat: json\n".
                "ResponseHeader: fixed16\n".
                "Columns: acknowledged active_checks_enabled alias display_name has_been_checked last_check last_state_change name plugin_output scheduled_downtime_depth state state_type\n\n");

    $json = json_decode($read, false); 
    $res = array();
    foreach ($json as $entry) {
        $tabentry = array();
        $tabentry['acknowledged'] = $entry[0];
        $tabentry['active_checks_enabled'] = $entry[1];
        $tabentry['alias'] = $entry[2];
        $tabentry['display_name'] = $entry[3];
        $tabentry['has_been_checked'] = $entry[4];
        $tabentry['last_check'] = $entry[5];
        $tabentry['last_state_change'] = $entry[6];
        $tabentry['name'] = $entry[7];
        $tabentry['plugin_output'] = $entry[8];
        $tabentry['scheduled_downtime_depth'] = $entry[9];
        $tabentry['state'] = $entry[10];
        $tabentry['state_type'] = $entry[11];

        /* compatibility hack with NDO */
        $tabentry['name1'] = $tabentry['name'];
        $tabentry['current_state'] = $tabentry['state'];
        $tabentry['output'] = $tabentry['plugin_output'];
        $tabentry['problem_has_been_acknowledged'] = $tabentry['acknowledged'];
        $tabentry['last_check'] = date("Y-m-d H:i:s" ,$tabentry['last_check']);
        $tabentry['last_state_change'] = date("Y-m-d H:i:s" ,$tabentry['last_state_change']);

        array_push($res,$tabentry);
    }
    $res = subval_sort($res,'name');

    return $res;
}

function readHostsByGroup($hostgroups) {

    $filter = "";
    $or = 0;
    foreach ($hostgroups as $hg) {
        $filter .= "Filter: hostgroup_name = $hg\n";
        $or++;
    }
    if ($or > 1) {
        $filter .= "Or: $or\n";
    }

    $read = readLiveData(    "GET hostsbygroup\n".
                $filter.
                "OutputFormat: json\n".
                "ResponseHeader: fixed16\n".
                "Columns: acknowledged active_checks_enabled alias display_name has_been_checked last_check last_state_change name plugin_output scheduled_downtime_depth state state_type\n\n");

    $json = json_decode($read, false); 
    $res = array();
    foreach ($json as $entry) {
        $tabentry = array();
        $tabentry['acknowledged'] = $entry[0];
        $tabentry['active_checks_enabled'] = $entry[1];
        $tabentry['alias'] = $entry[2];
        $tabentry['display_name'] = $entry[3];
        $tabentry['has_been_checked'] = $entry[4];
        $tabentry['last_check'] = $entry[5];
        $tabentry['last_state_change'] = $entry[6];
        $tabentry['name'] = $entry[7];
        $tabentry['plugin_output'] = $entry[8];
        $tabentry['scheduled_downtime_depth'] = $entry[9];
        $tabentry['state'] = $entry[10];
        $tabentry['state_type'] = $entry[11];

        /* compatibility hack with NDO */
        $tabentry['name1'] = $tabentry['name'];
        $tabentry['current_state'] = $tabentry['state'];
        $tabentry['output'] = $tabentry['plugin_output'];
        $tabentry['problem_has_been_acknowledged'] = $tabentry['acknowledged'];
        $tabentry['last_check'] = date("Y-m-d H:i:s" ,$tabentry['last_check']);
        $tabentry['last_state_change'] = date("Y-m-d H:i:s" ,$tabentry['last_state_change']);

        array_push($res,$tabentry);
    }
    $res = subval_sort($res,'name');

    return $res;
}

function readServices() {

    $read = readLiveData(    "GET services\n".
                "OutputFormat: json\n".
                "ResponseHeader: fixed16\n".
                "Columns: acknowledged active_checks_enabled description has_been_checked host_name last_check last_state_change plugin_output scheduled_downtime_depth state state_type\n\n");

    $json = json_decode($read, false); 
    $res = array();
    foreach ($json as $entry) {
        $tabentry = array();
        $tabentry['acknowledged'] = $entry[0];
        $tabentry['active_checks_enabled'] = $entry[1];
        $tabentry['description'] = $entry[2];
        $tabentry['has_been_checked'] = $entry[3];
        $tabentry['host_name'] = $entry[4];
        $tabentry['last_check'] = $entry[5];
        $tabentry['last_state_change'] = $entry[6];
        $tabentry['plugin_output'] = $entry[7];
        $tabentry['scheduled_downtime_depth'] = $entry[8];
        $tabentry['state'] = $entry[9];
        $tabentry['state_type'] = $entry[10];

         /* compatibility hack with NDO */
        $tabentry['name1'] = $tabentry['host_name'];
        $tabentry['name2'] = $tabentry['description'];
        $tabentry['current_state'] = $tabentry['state'];
        $tabentry['output'] = $tabentry['plugin_output'];
        $tabentry['problem_has_been_acknowledged'] = $tabentry['acknowledged'];
        $tabentry['last_check'] = date("Y-m-d H:i:s" ,$tabentry['last_check']);
        $tabentry['last_state_change'] = date("Y-m-d H:i:s" ,$tabentry['last_state_change']);

        array_push($res,$tabentry);
    }
    $res = subval_sort_multi($res,'host_name','description');
    return $res;
}

function readServicesByHostgroup($hostgroups) {
    
    $filter = "";
    $or = 0;
    foreach ($hostgroups as $hg) {
        $filter .= "Filter: hostgroup_name = $hg\n";
        $or++;
    }
    if ($or > 1) {
        $filter .= "Or: $or\n";
    }

    $read = readLiveData(    "GET servicesbyhostgroup\n".
                $filter.
                "OutputFormat: json\n".
                "ResponseHeader: fixed16\n".
                "Columns: acknowledged active_checks_enabled description has_been_checked host_name last_check last_state_change plugin_output scheduled_downtime_depth state state_type\n\n");

    $json = json_decode($read, false); 
    $res = array();
    foreach ($json as $entry) {
        $tabentry = array();
        $tabentry['acknowledged'] = $entry[0];
        $tabentry['active_checks_enabled'] = $entry[1];
        $tabentry['description'] = $entry[2];
        $tabentry['has_been_checked'] = $entry[3];
        $tabentry['host_name'] = $entry[4];
        $tabentry['last_check'] = $entry[5];
        $tabentry['last_state_change'] = $entry[6];
        $tabentry['plugin_output'] = $entry[7];
        $tabentry['scheduled_downtime_depth'] = $entry[8];
        $tabentry['state'] = $entry[9];
        $tabentry['state_type'] = $entry[10];

         /* compatibility hack with NDO */
        $tabentry['name1'] = $tabentry['host_name'];
        $tabentry['name2'] = $tabentry['description'];
        $tabentry['current_state'] = $tabentry['state'];
        $tabentry['output'] = $tabentry['plugin_output'];
        $tabentry['problem_has_been_acknowledged'] = $tabentry['acknowledged'];
        $tabentry['last_check'] = date("Y-m-d H:i:s" ,$tabentry['last_check']);
        $tabentry['last_state_change'] = date("Y-m-d H:i:s" ,$tabentry['last_state_change']);

        array_push($res,$tabentry);
    }
    $res = subval_sort_multi($res,'host_name','description');
    return $res;
}


function readServicesByServicegroup($servicegroups) {
    
    $filter = "";
    $or = 0;
    foreach ($servicegroups as $sg) {
        $filter .= "Filter: servicegroup_name = $sg\n";
        $or++;
    }
    if ($or > 1) {
        $filter .= "Or: $or\n";
    }

    $read = readLiveData(    "GET servicesbygroup\n".
                $filter.
                "OutputFormat: json\n".
                "ResponseHeader: fixed16\n".
                "Columns: acknowledged active_checks_enabled description has_been_checked host_name last_check last_state_change plugin_output scheduled_downtime_depth state state_type\n\n");

    $json = json_decode($read, false); 
    $res = array();
    foreach ($json as $entry) {
        $tabentry = array();
        $tabentry['acknowledged'] = $entry[0];
        $tabentry['active_checks_enabled'] = $entry[1];
        $tabentry['description'] = $entry[2];
        $tabentry['has_been_checked'] = $entry[3];
        $tabentry['host_name'] = $entry[4];
        $tabentry['last_check'] = $entry[5];
        $tabentry['last_state_change'] = $entry[6];
        $tabentry['plugin_output'] = $entry[7];
        $tabentry['scheduled_downtime_depth'] = $entry[8];
        $tabentry['state'] = $entry[9];
        $tabentry['state_type'] = $entry[10];

         /* compatibility hack with NDO */
        $tabentry['name1'] = $tabentry['host_name'];
        $tabentry['name2'] = $tabentry['description'];
        $tabentry['current_state'] = $tabentry['state'];
        $tabentry['output'] = $tabentry['plugin_output'];
        $tabentry['problem_has_been_acknowledged'] = $tabentry['acknowledged'];
        $tabentry['last_check'] = date("Y-m-d H:i:s" ,$tabentry['last_check']);
        $tabentry['last_state_change'] = date("Y-m-d H:i:s" ,$tabentry['last_state_change']);

        array_push($res,$tabentry);
    }
    $res = subval_sort_multi($res,'host_name','description');
    return $res;
}


function readStatus() {

    $read = readLiveData(    "GET status\n".
                "OutputFormat: json\n".
                "ResponseHeader: fixed16\n\n");

    $json = json_decode($read, false); 
    print_r2($json);
    return $json;
}

function readHostGroups() {

    $read = readLiveData(    "GET hostgroups\n".
                "OutputFormat: json\n".
                "ResponseHeader: fixed16\n".
                "Columns: name members\n\n");

    print_r2($read);
    $json = json_decode($read, false); 
    print_r2($json);
    return $json;
}

function readHistory() {
    global $history_time_limit, $history_size_limit;

    // get last 2hours and limit 50 entry
    $ftime = time() - $history_time_limit;

    $read = readLiveData(    "GET log\n".
                "OutputFormat: json\n".
                "ResponseHeader: fixed16\n".
                "Columns: type state time host_name service_description plugin_output\n".
                "Filter: state_type = HARD\n".
                "Filter: state > 0\n".
                "Filter: time > $ftime\n".
                "Limit: $history_size_limit\n\n");

    $json = json_decode($read, false); 
    $res = array();
    foreach ($json as $entry) {
        $tabentry = array();
        $tabentry['objecttype_id'] = $entry[0];
        $tabentry['state'] = $entry[1];
        $tabentry['state_time'] = date("Y-m-d H:i:s",$entry[2]);
        $tabentry['name1'] = $entry[3];
        $tabentry['name2'] = $entry[4];
        $tabentry['output'] = $entry[5];
        array_push($res,$tabentry);
    }
    return $res;
}

function readHistoryByHostgroup($hostgroups) {
    global $history_time_limit, $history_size_limit;

    // get last 2hours and limit 50 entry
    $ftime = time() - $history_time_limit;

    $read = readLiveData(    "GET log\n".
                "OutputFormat: json\n".
                "ResponseHeader: fixed16\n".
                "Columns: type state time host_name service_description plugin_output current_host_groups\n".
                "Filter: state_type = HARD\n".
                "Filter: state > 0\n".
                "Filter: time > $ftime\n".
                "Limit: $history_size_limit\n\n");

    $json = json_decode($read, false); 
    $res = array();
    foreach ($json as $entry) {
        $tabentry = array();
        $tabentry['objecttype_id'] = $entry[0];
        $tabentry['state'] = $entry[1];
        $tabentry['state_time'] = date("Y-m-d H:i:s",$entry[2]);
        $tabentry['name1'] = $entry[3];
        $tabentry['name2'] = $entry[4];
        $tabentry['output'] = $entry[5];
        foreach ($entry[6] as $grp) {
            if (in_array($grp,$hostgroups)) {
                array_push($res,$tabentry);
                break;
            }
        }
    }
    return $res;
}

?>
