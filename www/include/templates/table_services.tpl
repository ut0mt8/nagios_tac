<div id="{$id}">
<table width="98%">
<tr><th colspan="7" align="left">&nbsp;:: {$title}</th></tr>
{if count($table) gt 0 }
<tr>
 <td class="table_headers">HostName</td>
 <td class="table_headers">ServiceName</td>
 <td class="table_headers">Status</td>
 <td class="table_headers">Last Check</td>
 <td class="table_headers">Last Change</td>
 <td class="table_headers">Status Output</td>
 <td class="table_headers">Actions</td>
</tr>
{assign var=hostname value=''}
{foreach key=key item=item from=$table}
<tr class="output">
{if $item.name1 eq $hostname }
 <td style="background-color: transparent;"> </td>
{else}
 {assign var=hostname value=$item.name1}
 <td nowrap>
 <a class="click" href="#" onclick="{ajax_update update_id="services_problem" function="display_table_services_host" params="host=`$item.name1`"}">{$hostname}</a>
 </td>
{/if}
 <td> {$item.name2} </td>
 <td class="{$class}"> {$item.current_status} </td>
 <td nowrap> {$item.last_check} </td>
 <td nowrap> {$item.last_state_change} </td>
 <td> {$item.output}</td>
 <td>
   <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=ack_service&host=`$item.name1`&service=`$item.name2`"}">A</a>
   <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=dis_service&host=`$item.name1`&service=`$item.name2`"}">D</a>
   <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=en_service&host=`$item.name1`&service=`$item.name2`"}">E</a> 
   <a class="click" href="#" onclick="{ajax_update update_id="status_bar" function="nagios_cmd" params="action=ok_service&host=`$item.name1`&service=`$item.name2`"}">O</a> 
 </td>
<tr/>
{/foreach}
{else}
<tr class="output"><td align="left"> No item here</td></tr>
{/if}
</table>
</div>

