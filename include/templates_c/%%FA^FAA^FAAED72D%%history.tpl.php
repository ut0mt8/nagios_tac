<?php /* Smarty version 2.6.25-dev, created on 2016-09-06 17:33:06
         compiled from history.tpl */ ?>
<div id="<?php echo $this->_tpl_vars['id']; ?>
">
<table width="98%">
<tr><th colspan="6" align="left">&nbsp;:: Alerts History</th></tr>
<?php if (( count ( $this->_tpl_vars['history'] ) ) > 0): ?>
<tr>
 <td class="table_headers"> </td>
 <td class="table_headers">Date</td>
 <td class="table_headers">HostName</td>
 <td class="table_headers">ServiceName</td>
 <td class="table_headers">Status</td>
 <td class="table_headers">Output</td>
</tr>
<?php $_from = $this->_tpl_vars['history']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<tr class="output">
<td nowrap>
<?php if ($this->_tpl_vars['item']['status'] == 'Warning'): ?>
 <img height="15px" src="images/warning.png" alt="">
<?php endif; ?>
<?php if ($this->_tpl_vars['item']['status'] == 'Critical' || $this->_tpl_vars['item']['status'] == 'DOWN' || $this->_tpl_vars['item']['status'] == 'Unreachable'): ?>
 <img height="15px" src="images/critical.png" alt="">
<?php endif; ?>
<?php if ($this->_tpl_vars['item']['status'] == 'OK' || $this->_tpl_vars['item']['status'] == 'UP'): ?>
 <img height="15px" src="images/recovery.png" alt="">
<?php endif; ?>
<?php if ($this->_tpl_vars['item']['status'] == 'Unknown'): ?>
 <img height="15px" src="images/unknown.png" alt="">
<?php endif; ?>
</td>
 <td nowrap> <?php echo $this->_tpl_vars['item']['state_time']; ?>
 </td>
 <td nowrap> <?php echo $this->_tpl_vars['item']['name1']; ?>
 </td>
 <td nowrap> <?php echo $this->_tpl_vars['item']['name2']; ?>
 </td>
 <td nowrap> <?php echo $this->_tpl_vars['item']['status']; ?>
 </td>
 <td width="100%"> <?php echo $this->_tpl_vars['item']['output']; ?>
 </td>
<tr/>
<?php endforeach; endif; unset($_from); ?>
<?php else: ?>
<tr class="output"><td align="left"> No Alerts in history...</td></tr>
<?php endif; ?>
</table>
</div>
