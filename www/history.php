<?php

require_once('include/bootstrap.php');
require_once('include/history.php');

/* Make the tactical page */
$smarty->display('header.tpl');
$smarty->assign ("id", "history");
$smarty->display('history.tpl');
$smarty->display('footer.tpl');
/* -- -- */

?>
