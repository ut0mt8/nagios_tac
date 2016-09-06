<div id="{$id}">
{if count($hosts_down_unhandled) gt 0 }
<table id="table_{$id}" width="85%">
<tr><th colspan="6" align="left">&nbsp;:: {$title}</th></tr>
<tr class="output">
 <td class="table_headers">HostName</td>
 <td class="table_headers">Status</td>
 <td class="table_headers">Last Check</td>
 <td class="table_headers">Last Change</td>
 <td class="table_headers">Status Output</td>
 <td class="table_headers">Actions</td>
 </tr>
{foreach key=key item=item from=$hosts_down_unhandled}
<tr class="output">
 <td> 
 <a class="click" href="#" onclick="{ajax_update update_id="services_problem" function="display_table_services_host" params="host=`$item.name1`"}">{$item.name1}</a>
 </td>
 <td class="hosts_down"> {$item.current_status} </td>
 <td nowrap> {$item.last_check} </td>
 <td nowrap> {$item.last_state_change} </td>
 <td> {$item.output}</td>
 <td>
   <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=ack_host&host=`$item.name1`"}">A</a>
   <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=dis_host&host=`$item.name1`"}">D</a>
   <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=en_host&host=`$item.name1`"}">E</a>
   <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=rsched_host&host=`$item.name1`"}">R</a>
 </td>
<tr/>
{/foreach}
</table>
{else}
{* <tr class="output"><td align="left"> No item here</td></tr> *}
{/if}
</div>
