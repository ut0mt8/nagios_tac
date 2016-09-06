<?php /* Smarty version 2.6.25-dev, created on 2016-09-06 17:33:06
         compiled from hosts.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ajax_update', 'hosts.tpl', 7, false),array('modifier', 'count', 'hosts.tpl', 7, false),)), $this); ?>
<div id="Hosts">
<table>
<tr><th colspan="4" align="Left">&nbsp;:: Hosts</th></tr>
<tr>
 <td width="130" valign="top">
 <div class="count">
 	<a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'hosts_down_problem','function' => 'display_table_hosts','params' => "view=hosts_down"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['hosts_down']); ?>
 Down </a>
 </div>

<table class="problem" width="100%">
<?php if (count ( $this->_tpl_vars['hosts_down_acknowledged'] ) > 0): ?>
<tr>
 <td class="hosts_down_ok"><a class="Click" onclick="<?php echo smarty_function_ajax_update(array('update_id' => 'hosts_down_problem','function' => 'display_table_hosts','params' => "view=hosts_down_acknowledged"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['hosts_down_acknowledged']); ?>
 Acknowledged </a></td>
<tr/>
<?php endif; ?> 

<?php if (count ( $this->_tpl_vars['hosts_down_disabled'] ) > 0): ?>
<tr>
 <td class="hosts_down_ok"><a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'hosts_down_problem','function' => 'display_table_hosts','params' => "view=hosts_down_disabled"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['hosts_down_disabled']); ?>
 Disabled </a></td>
<tr/>
<?php endif; ?> 

<?php if (count ( $this->_tpl_vars['hosts_down_scheduled'] ) > 0): ?>
<tr>
 <td class="hosts_down_ok"><a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'hosts_down_problem','function' => 'display_table_hosts','params' => "view=hosts_down_scheduled"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['hosts_down_scheduled']); ?>
 Scheduled </a></td>
<tr/>
<?php endif; ?> 

<?php if (count ( $this->_tpl_vars['hosts_down_unhandled'] ) > 0): ?>
<tr>
 <td class="hosts_down"><a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'hosts_down_problem','function' => 'display_table_hosts','params' => "view=hosts_down_unhandled"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['hosts_down_unhandled']); ?>
 Unhandled </a></td>
<tr/>
<?php endif; ?> 
</table>
</td>

<td width="130" valign="top">
<div class="count">
 <div class="hosts_unreachable">
 	<a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'hosts_down_problem','function' => 'display_table_hosts','params' => "view=hosts_unreachable"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['hosts_unreachable']); ?>
 Unreachable </a>
 </div>
</div>
</td>

<td width="130" valign="top">
<div class="count">
 <div class="hosts_up">
 	<a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'hosts_down_problem','function' => 'display_table_hosts','params' => "view=hosts_up"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['hosts_up']); ?>
 Up </a>
 </div>
</div>
</td>

<td width="130" valign="top">
<div class="count">
 <div class="hosts_pending">
 	<a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'hosts_down_problem','function' => 'display_table_hosts','params' => "view=hosts_pending"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['hosts_pending']); ?>
 Pending </a>
 </div>
</div>
</td>
</tr>
</table>
</div>
