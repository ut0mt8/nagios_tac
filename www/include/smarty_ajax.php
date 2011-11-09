<?php

$ajax_export_list = array();

function ajax_register() {
  global $ajax_export_list;

  $n = func_num_args();
  for ($i = 0; $i < $n; $i++) {
  	$ajax_export_list[] = func_get_arg($i);
  }
}

function ajax_process_call() {
  global $ajax_export_list;

  if (!isset($_REQUEST['f'])) return;
  $function = $_REQUEST['f'];
  if (false !== array_search($function, $ajax_export_list)) call_user_func($function);
  exit();
}

?>
