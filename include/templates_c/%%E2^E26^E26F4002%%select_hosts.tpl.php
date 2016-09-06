<?php /* Smarty version 2.6.25-dev, created on 2016-09-06 17:33:06
         compiled from select_hosts.tpl */ ?>
<div id="<?php echo $this->_tpl_vars['id']; ?>
">
<select onchange="SmartyAjax.update('services_problem', '', 'get', 'host='+this.options[this.selectedIndex].value+'&f=display_table_services_host'); return false;">
 <option class="option" value="all" selected> </option>
<?php $_from = $this->_tpl_vars['table']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
 <option class="option" value="<?php echo $this->_tpl_vars['item']['name1']; ?>
"><?php echo $this->_tpl_vars['item']['name1']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
</div>