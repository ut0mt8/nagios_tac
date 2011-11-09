<div id="{$id}">
<table width="85%">
<tr><th colspan="6" align="left">&nbsp;:: {$title}</th></tr>
{if count($table) gt 0 }
<tr class="output">
 <td class="table_headers">HostName</td>
 <td class="table_headers">Status</td>
 <td class="table_headers">Last Check</td>
 <td class="table_headers">Last Change</td>
 <td class="table_headers">Status Output</td>
 <td class="table_headers">Actions</td>
 </tr>
{foreach key=key item=item from=$table}
<tr class="output">
 <td>
 <a class="click" href="#" onclick="{ajax_update update_id="services_problem" function="display_table_services_host" params="host=`$item.name1`"}">{$item.name1}</a>
 </td>
 <td class="{$class}"> {$item.current_status} </td>
 <td nowrap> {$item.last_check} </td>
 <td nowrap> {$item.last_state_change} </td>
 <td> {$item.output}</td>
 <td>
   <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=ack_host&host=`$item.name1`"}">A</a>
   <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=dis_host&host=`$item.name1`"}">D</a>
   <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=en_host&host=`$item.name1`"}">E</a>
 </td>
<tr/>
{/foreach}
{else}
<tr class="output"><td align="left"> No item here</td></tr>
{/if}
</table>
</div>

