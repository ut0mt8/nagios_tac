<?php

require_once('include/bootstrap.php');

if (isset($_GET['timestamp'])) {
	$ts = $_GET['timestamp'];
	if (is_numeric($ts)) {
		$ts = round($ts/1000);
		$j = readLiveJson("GET log\nFilter: state_type = HARD\nColumns: time\nLimit: 1");
		//Filter: time > $ftime\n".
		$last_update = $j[0][0];
		if ($last_update > $ts) {
			//echo "changed at $ts";
			echo "._.";
		}
	}
}
?>
