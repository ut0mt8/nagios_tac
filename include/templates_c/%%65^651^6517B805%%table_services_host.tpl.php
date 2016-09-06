<?php /* Smarty version 2.6.25-dev, created on 2016-08-31 16:17:33
         compiled from table_services_host.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ajax_update', 'table_services_host.tpl', 41, false),)), $this); ?>
<div id="<?php echo $this->_tpl_vars['id']; ?>
">
<table width="98%">
<tr><th colspan="7" align="left">&nbsp;:: <?php echo $this->_tpl_vars['title']; ?>
</th></tr>
<?php if (count ( $this->_tpl_vars['table'] ) > 0): ?>
<tr>
 <td class="table_headers">HostName</td>
 <td class="table_headers">ServiceName</td>
 <td class="table_headers">Status</td>
 <td class="table_headers">Last Check</td>
 <td class="table_headers">Last Change</td>
 <td class="table_headers">Status Output</td>
 <td class="table_headers">Actions</td>
</tr>
<?php $this->assign('hostname', ''); ?>
<?php $_from = $this->_tpl_vars['table']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<tr class="output">
<?php if ($this->_tpl_vars['item']['name1'] == $this->_tpl_vars['hostname']): ?>
 <td style="background-color: transparent;"> </td>
<?php else: ?>
 <?php $this->assign('hostname', $this->_tpl_vars['item']['name1']); ?>
 <td nowrap> <?php echo $this->_tpl_vars['hostname']; ?>
 </td>
<?php endif; ?>
 <td> <?php echo $this->_tpl_vars['item']['name2']; ?>
 </td>
<?php if ($this->_tpl_vars['item']['current_status'] == 'OK'): ?> 
 <td class="services_ok">
<?php endif; ?>
<?php if ($this->_tpl_vars['item']['current_status'] == 'Warning'): ?> 
 <td class="services_warning">
<?php endif; ?>
<?php if ($this->_tpl_vars['item']['current_status'] == 'Critical'): ?> 
 <td class="services_nok">
<?php endif; ?>
<?php if ($this->_tpl_vars['item']['current_status'] == 'Unknown'): ?> 
 <td class="services_unknown">
<?php endif; ?>
 <?php echo $this->_tpl_vars['item']['current_status']; ?>
 </td>
 <td nowrap> <?php echo $this->_tpl_vars['item']['last_check']; ?>
 </td>
 <td nowrap> <?php echo $this->_tpl_vars['item']['last_state_change']; ?>
 </td>
 <td> <?php echo $this->_tpl_vars['item']['output']; ?>
</td>
 <td>
   <a class="click" href="#" onclick="<?php echo smarty_function_ajax_update(array('update_id' => 'status_bar','function' => 'nagios_cmd','params' => "action=ack_service&host=".($this->_tpl_vars['item']['name1'])."&service=".($this->_tpl_vars['item']['name2'])), $this);?>
">A</a>
   <a class="click" href="#" onclick="<?php echo smarty_function_ajax_update(array('update_id' => 'status_bar','function' => 'nagios_cmd','params' => "action=dis_service&host=".($this->_tpl_vars['item']['name1'])."&service=".($this->_tpl_vars['item']['name2'])), $this);?>
">D</a>
   <a class="click" href="#" onclick="<?php echo smarty_function_ajax_update(array('update_id' => 'status_bar','function' => 'nagios_cmd','params' => "action=en_service&host=".($this->_tpl_vars['item']['name1'])."&service=".($this->_tpl_vars['item']['name2'])), $this);?>
">E</a> 
   <a class="click" href="#" onclick="<?php echo smarty_function_ajax_update(array('update_id' => 'status_bar','function' => 'nagios_cmd','params' => "action=ok_service&host=".($this->_tpl_vars['item']['name1'])."&service=".($this->_tpl_vars['item']['name2'])), $this);?>
">O</a> 
   <a class="click" href="#" onclick="<?php echo smarty_function_ajax_update(array('update_id' => 'status_bar','function' => 'nagios_cmd','params' => "action=rsched_service&host=".($this->_tpl_vars['item']['name1'])."&service=".($this->_tpl_vars['item']['name2'])), $this);?>
">R</a>
 </td>
<tr/>
<?php endforeach; endif; unset($_from); ?>
<?php else: ?>
<tr class="output"><td align="left"> No item here</td></tr>
<?php endif; ?>
</table>
</div>
