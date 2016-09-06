<?php /* Smarty version 2.6.25-dev, created on 2016-09-06 17:33:06
         compiled from services.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ajax_update', 'services.tpl', 8, false),array('modifier', 'count', 'services.tpl', 8, false),)), $this); ?>
<div id="Services">
<table>
<tr><th colspan="5" align="Left">&nbsp;:: Services</th></tr>
<tr>

<td width="130" valign="top">
<div class="count">
 	<a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'services_problem','function' => 'display_table_services','params' => "view=services_critical"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['services_critical']); ?>
 Critical </a>
</div>

<table class="problem" width="100%">
<?php if (count ( $this->_tpl_vars['services_critical_acknowledged'] ) > 0): ?>
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'services_problem','function' => 'display_table_services','params' => "view=services_critical_acknowledged"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['services_critical_acknowledged']); ?>
 Acknowledged </a></td>
<tr/>
<?php endif; ?> 

<?php if (count ( $this->_tpl_vars['services_critical_disabled'] ) > 0): ?>
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'services_problem','function' => 'display_table_services','params' => "view=services_critical_disabled"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['services_critical_disabled']); ?>
 Disabled </a></td>
<tr/>
<?php endif; ?> 

<?php if (count ( $this->_tpl_vars['services_critical_scheduled'] ) > 0): ?>
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'services_problem','function' => 'display_table_services','params' => "view=services_critical_scheduled"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['services_critical_scheduled']); ?>
 Scheduled </a></td>
<tr/>
<?php endif; ?> 

<?php if (count ( $this->_tpl_vars['services_critical_hostdown'] ) > 0): ?>
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'services_problem','function' => 'display_table_services','params' => "view=services_critical_hostdown"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['services_critical_hostdown']); ?>
 on Problem Hosts </a></td>
<tr/>
<?php endif; ?> 

<?php if (count ( $this->_tpl_vars['services_critical_unhandled'] ) > 0): ?>
<tr>
 <td class="services_nok"><a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'services_problem','function' => 'display_table_services','params' => "view=services_critical_unhandled"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['services_critical_unhandled']); ?>
 Unhandled </a></td>
<tr/>
<?php endif; ?> 
</table>
</td>

<td width="130" valign="top">
<div class="count">
 	<a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'services_problem','function' => 'display_table_services','params' => "view=services_warning"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['services_warning']); ?>
 Warning </a>
</div>

<table class="problem" width="100%">
<?php if (count ( $this->_tpl_vars['services_warning_acknowledged'] ) > 0): ?>
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'services_problem','function' => 'display_table_services','params' => "view=services_warning_acknowledged"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['services_warning_acknowledged']); ?>
 Acknowledged </a></td>
<tr/>
<?php endif; ?> 

<?php if (count ( $this->_tpl_vars['services_warning_disabled'] ) > 0): ?>
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'services_problem','function' => 'display_table_services','params' => "view=services_warning_disabled"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['services_warning_disabled']); ?>
 Disabled </a></td>
<tr/>
<?php endif; ?> 

<?php if (count ( $this->_tpl_vars['services_warning_scheduled'] ) > 0): ?>
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'services_problem','function' => 'display_table_services','params' => "view=services_warning_scheduled"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['services_warning_scheduled']); ?>
 Scheduled </a></td>
<tr/>
<?php endif; ?> 

<?php if (count ( $this->_tpl_vars['services_warning_hostdown'] ) > 0): ?>
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'services_problem','function' => 'display_table_services','params' => "view=services_warning_hostdown"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['services_warning_hostdown']); ?>
 on Problem Hosts </a></td>
<tr/>
<?php endif; ?> 

<?php if (count ( $this->_tpl_vars['services_warning_unhandled'] ) > 0): ?>
<tr>
 <td class="services_warning"><a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'services_problem','function' => 'display_table_services','params' => "view=services_warning_unhandled"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['services_warning_unhandled']); ?>
 Unhandled </a></td>
<tr/>
<?php endif; ?> 
</table>
</td>

<td width="130" valign="top">
<div class="count">
 	<a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'services_problem','function' => 'display_table_services','params' => "view=services_unknown"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['services_unknown']); ?>
 Unknown </a>
</div>

<table class="problem" width="100%">
<?php if (count ( $this->_tpl_vars['services_unknown_acknowledged'] ) > 0): ?>
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'services_problem','function' => 'display_table_services','params' => "view=services_unknown_acknowledged"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['services_unknown_acknowledged']); ?>
 Acknowledged </a></td>
<tr/>
<?php endif; ?> 

<?php if (count ( $this->_tpl_vars['services_unknown_disabled'] ) > 0): ?>
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'services_problem','function' => 'display_table_services','params' => "view=services_unknown_disabled"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['services_unknown_disabled']); ?>
 Disabled </a></td>
<tr/>
<?php endif; ?> 

<?php if (count ( $this->_tpl_vars['services_unknown_scheduled'] ) > 0): ?>
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'services_problem','function' => 'display_table_services','params' => "view=services_unknown_scheduled"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['services_unknown_scheduled']); ?>
 Scheduled </a></td>
<tr/>
<?php endif; ?> 

<?php if (count ( $this->_tpl_vars['services_unknown_hostdown'] ) > 0): ?>
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'services_problem','function' => 'display_table_services','params' => "view=services_unknown_hostdown"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['services_unknown_hostdown']); ?>
 on Problem Hosts </a></td>
<tr/>
<?php endif; ?> 

<?php if (count ( $this->_tpl_vars['services_unknown_unhandled'] ) > 0): ?>
<tr>
 <td class="services_unknown"><a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'services_problem','function' => 'display_table_services','params' => "view=services_unknown_unhandled"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['services_unknown_unhandled']); ?>
 Unhandled </a></td>
<tr/>
<?php endif; ?> 
</table>
</td>

<td width="130" valign="top">
<div class="count">
 <div class="services_ok">
 	<a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'services_problem','function' => 'display_table_services','params' => "view=services_ok"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['services_ok']); ?>
 OK </a>
 </div>
</div>
</td>
<td width="130" valign="top">
<div class="count">
 <div class="services_pending">
 	<a class="Click" onClick="<?php echo smarty_function_ajax_update(array('update_id' => 'services_problem','function' => 'display_table_services','params' => "view=services_pending"), $this);?>
" href="#"> <?php echo count($this->_tpl_vars['services_pending']); ?>
 Pending </a>
 </div>
</div>
</td>

</tr>
</table>
</div>
