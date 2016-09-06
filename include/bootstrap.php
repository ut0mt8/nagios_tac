<?php

require_once('config.php');

global $engine;
require_once("${engine}.php");

require_once('smarty_ajax.php');
require('smarty/libs/Smarty.class.php');

global $smarty;
$smarty = new Smarty();

$smarty->debugging = false;
$smarty->force_compile = true;
$smarty->caching = false;
$smarty->compile_check = true;
$smarty->cache_lifetime = -1;
$smarty->plugins_dir = array( SMARTY_DIR . 'plugins', 'include/plugins');
$smarty->template_dir = '/var/www/netnag/include/templates';
$smarty->compile_dir = '/var/www/netnag/include/templates_c';

?>
