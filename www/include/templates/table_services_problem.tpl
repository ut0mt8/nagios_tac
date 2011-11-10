<div id="{$id}">
{if (count($services_critical_unhandled)+count($services_warning_unhandled)+count($services_unknown_unhandled) ) gt 0 }
<table id="table_{$id}" width="98%">
<tr><th colspan="7" align="left">&nbsp;:: {$title}</th></tr>
<tr>
 <td class="table_headers">HostName</td>
 <td class="table_headers">ServiceName</td>
 <td class="table_headers">Status</td>
 <td class="table_headers">Last Check</td>
 <td class="table_headers">Last Change</td>
 <td class="table_headers">Status Output</td>
 <td class="table_headers">Actions</td>
</tr>
{foreach key=key item=item from=$services_critical_unhandled}
<tr class="output">
 <td nowrap> <a class="click" href="#" onclick="{ajax_update update_id="services_problem" function="display_table_services_host" params="host=`$item.name1`"}">{$item.name1}</a> </td>
 <td> {$item.name2} </td>
 <td class="services_nok"> {$item.current_status} </td>
 <td nowrap> {$item.last_check} </td>
 <td nowrap> {$item.last_state_change} </td>
 <td> {$item.output}</td>
 <td> 
  <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=ack_service&host=`$item.name1`&service=`$item.name2`"}">A</a> 
  <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=dis_service&host=`$item.name1`&service=`$item.name2`"}">D</a> 
  <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=en_service&host=`$item.name1`&service=`$item.name2`"}">E</a> 
  <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=ok_service&host=`$item.name1`&service=`$item.name2`"}">O</a> 
  <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=rsched_service&host=`$item.name1`&service=`$item.name2`"}">R</a>
 </td>
<tr/>
{/foreach}
{foreach key=key item=item from=$services_warning_unhandled}
<tr class="output">
 <td nowrap> <a class="click" href="#" onclick="{ajax_update update_id="services_problem" function="display_table_services_host" params="host=`$item.name1`"}">{$item.name1}</a> </td>
 <td> {$item.name2} </td>
 <td class="services_warning"> {$item.current_status} </td>
 <td nowrap> {$item.last_check} </td>
 <td nowrap> {$item.last_state_change} </td>
 <td> {$item.output}</td>
 <td> 
  <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=ack_service&host=`$item.name1`&service=`$item.name2`"}">A</a> 
  <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=dis_service&host=`$item.name1`&service=`$item.name2`"}">D</a> 
  <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=en_service&host=`$item.name1`&service=`$item.name2`"}">E</a> 
  <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=ok_service&host=`$item.name1`&service=`$item.name2`"}">O</a> 
  <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=rsched_service&host=`$item.name1`&service=`$item.name2`"}">R</a>
 </td>
<tr/>
{/foreach}
{foreach key=key item=item from=$services_unknown_unhandled}
<tr class="output">
 <td nowrap> <a class="click" href="#" onclick="{ajax_update update_id="services_problem" function="display_table_services_host" params="host=`$item.name1`"}">{$item.name1}</a> </td>
 <td> {$item.name2} </td>
 <td class="services_unknown"> {$item.current_status} </td>
 <td nowrap> {$item.last_check} </td>
 <td nowrap> {$item.last_state_change} </td>
 <td class="output"> {$item.output}</td>
 <td> 
  <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=ack_service&host=`$item.name1`&service=`$item.name2`"}">A</a> 
  <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=dis_service&host=`$item.name1`&service=`$item.name2`"}">D</a> 
  <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=en_service&host=`$item.name1`&service=`$item.name2`"}">E</a> 
  <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=ok_service&host=`$item.name1`&service=`$item.name2`"}">O</a> 
  <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=rsched_service&host=`$item.name1`&service=`$item.name2`"}">R</a>
 </td>
<tr/>
{/foreach}
</table>
{else}
{* <tr class="output"><td align="left"> No item here</td></tr> *}
{/if}
</div>

