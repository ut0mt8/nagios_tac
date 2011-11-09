<?php

require_once('include/bootstrap.php');

$smarty->display('header.tpl');

$j = readLiveJson("GET columns\nColumns: name table type description");

print "<table>";
foreach ($j as $entry) {
	print "<tr>\n";
	foreach ($entry as $col) {
		print "<td>$col</td>";
	}
	print "</tr>\n";
}

print "</table>";

$smarty->display('footer.tpl');
/* -- -- */

?>
