<div id="Hosts">

<table width="220">
<tr><th> Up </th><th> Down </th><th> Unreachable </th><th> Pending </th></tr>
<tr>
<td>
<div class="count">
<div class="hosts_up">
 	<a class="Click" onClick="{ajax_update update_id="hosts_down_problem" function="display_table_hosts" params="view=hosts_up"}" href="#"> {$hosts_up|@count} </a>
</div>
</div>
</td>

<td>
<div class="count">
<div class="hosts_down">
 	<a class="Click" onClick="{ajax_update update_id="hosts_down_problem" function="display_table_hosts" params="view=hosts_down"}" href="#"> {$hosts_down|@count} </a>
</div>
</div>
</td>

<td>
<div class="count">
<div class="hosts_unreachable">
 	<a class="Click" onClick="{ajax_update update_id="hosts_down_problem" function="display_table_hosts" params="view=hosts_unreachable"}" href="#"> {$hosts_unreachable|@count} </a>
</div>
</div>
</td>

<td>
<div class="count">
<div class="hosts_pending">
 	<a class="Click" onClick="{ajax_update update_id="hosts_down_problem" function="display_table_hosts" params="view=hosts_pending"}" href="#"> {$hosts_pending|@count} </a>
</div>
</div>
</td>
</tr>

</table>
</div>

