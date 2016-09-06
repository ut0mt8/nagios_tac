<?php /* Smarty version 2.6.25-dev, created on 2016-09-06 17:33:06
         compiled from table_hosts_problem.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ajax_update', 'table_hosts_problem.tpl', 16, false),)), $this); ?>
<div id="<?php echo $this->_tpl_vars['id']; ?>
">
<?php if (count ( $this->_tpl_vars['hosts_down_unhandled'] ) > 0): ?>
<table id="table_<?php echo $this->_tpl_vars['id']; ?>
" width="85%">
<tr><th colspan="6" align="left">&nbsp;:: <?php echo $this->_tpl_vars['title']; ?>
</th></tr>
<tr class="output">
 <td class="table_headers">HostName</td>
 <td class="table_headers">Status</td>
 <td class="table_headers">Last Check</td>
 <td class="table_headers">Last Change</td>
 <td class="table_headers">Status Output</td>
 <td class="table_headers">Actions</td>
 </tr>
<?php $_from = $this->_tpl_vars['hosts_down_unhandled']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<tr class="output">
 <td> 
 <a class="click" href="#" onclick="<?php echo smarty_function_ajax_update(array('update_id' => 'services_problem','function' => 'display_table_services_host','params' => "host=".($this->_tpl_vars['item']['name1'])), $this);?>
"><?php echo $this->_tpl_vars['item']['name1']; ?>
</a>
 </td>
 <td class="hosts_down"> <?php echo $this->_tpl_vars['item']['current_status']; ?>
 </td>
 <td nowrap> <?php echo $this->_tpl_vars['item']['last_check']; ?>
 </td>
 <td nowrap> <?php echo $this->_tpl_vars['item']['last_state_change']; ?>
 </td>
 <td> <?php echo $this->_tpl_vars['item']['output']; ?>
</td>
 <td>
   <a class="click" href="#" onclick="<?php echo smarty_function_ajax_update(array('update_id' => 'status_bar','function' => 'nagios_cmd','params' => "action=ack_host&host=".($this->_tpl_vars['item']['name1'])), $this);?>
">A</a>
   <a class="click" href="#" onclick="<?php echo smarty_function_ajax_update(array('update_id' => 'status_bar','function' => 'nagios_cmd','params' => "action=dis_host&host=".($this->_tpl_vars['item']['name1'])), $this);?>
">D</a>
   <a class="click" href="#" onclick="<?php echo smarty_function_ajax_update(array('update_id' => 'status_bar','function' => 'nagios_cmd','params' => "action=en_host&host=".($this->_tpl_vars['item']['name1'])), $this);?>
">E</a>
   <a class="click" href="#" onclick="<?php echo smarty_function_ajax_update(array('update_id' => 'status_bar','function' => 'nagios_cmd','params' => "action=rsched_host&host=".($this->_tpl_vars['item']['name1'])), $this);?>
">R</a>
 </td>
<tr/>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php else: ?>
<?php endif; ?>
</div>