<div id="Hosts">
<table>
<tr><th colspan="4" align="Left">&nbsp;:: Hosts</th></tr>
<tr>
 <td width="130" valign="top">
 <div class="count">
 	<a class="Click" onClick="{ajax_update update_id="hosts_down_problem" function="display_table_hosts" params="view=hosts_down"}" href="#"> {$hosts_down|@count} Down </a>
 </div>

<table class="problem" width="100%">
{if count($hosts_down_acknowledged) gt 0 }
<tr>
 <td class="hosts_down_ok"><a class="Click" onclick="{ajax_update update_id="hosts_down_problem" function="display_table_hosts" params="view=hosts_down_acknowledged"}" href="#"> {$hosts_down_acknowledged|@count} Acknowledged </a></td>
<tr/>
{/if} 

{if count($hosts_down_disabled) gt 0 }
<tr>
 <td class="hosts_down_ok"><a class="Click" onClick="{ajax_update update_id="hosts_down_problem" function="display_table_hosts" params="view=hosts_down_disabled"}" href="#"> {$hosts_down_disabled|@count} Disabled </a></td>
<tr/>
{/if} 

{if count($hosts_down_scheduled) gt 0 }
<tr>
 <td class="hosts_down_ok"><a class="Click" onClick="{ajax_update update_id="hosts_down_problem" function="display_table_hosts" params="view=hosts_down_scheduled"}" href="#"> {$hosts_down_scheduled|@count} Scheduled </a></td>
<tr/>
{/if} 

{if count($hosts_down_unhandled) gt 0 }
<tr>
 <td class="hosts_down"><a class="Click" onClick="{ajax_update update_id="hosts_down_problem" function="display_table_hosts" params="view=hosts_down_unhandled"}" href="#"> {$hosts_down_unhandled|@count} Unhandled </a></td>
<tr/>
{/if} 
</table>
</td>

<td width="130" valign="top">
<div class="count">
 <div class="hosts_unreachable">
 	<a class="Click" onClick="{ajax_update update_id="hosts_down_problem" function="display_table_hosts" params="view=hosts_unreachable"}" href="#"> {$hosts_unreachable|@count} Unreachable </a>
 </div>
</div>
</td>

<td width="130" valign="top">
<div class="count">
 <div class="hosts_up">
 	<a class="Click" onClick="{ajax_update update_id="hosts_down_problem" function="display_table_hosts" params="view=hosts_up"}" href="#"> {$hosts_up|@count} Up </a>
 </div>
</div>
</td>

<td width="130" valign="top">
<div class="count">
 <div class="hosts_pending">
 	<a class="Click" onClick="{ajax_update update_id="hosts_down_problem" function="display_table_hosts" params="view=hosts_pending"}" href="#"> {$hosts_pending|@count} Pending </a>
 </div>
</div>
</td>
</tr>
</table>
</div>

