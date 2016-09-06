<?php

require_once('include/bootstrap.php');

$smarty->display('header.tpl');

/* status has 40 entries */
$status = readLiveJson("GET status");

print "<table>\n";
for ($i=0 ; $i < 40 ; $i++) {
	print "<tr>\n";
	print "<td>".$status[0][$i]."</td>\n";
	print "<td>".$status[1][$i]."</td>\n";
	print "</tr>\n";
}
print "</table>\n";

$smarty->display('footer.tpl');
/* -- -- */

?>
