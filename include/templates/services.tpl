<div id="Services">
<table>
<tr><th colspan="5" align="Left">&nbsp;:: Services</th></tr>
<tr>

<td width="130" valign="top">
<div class="count">
 	<a class="Click" onClick="{ajax_update update_id="services_problem" function="display_table_services" params="view=services_critical"}" href="#"> {$services_critical|@count} Critical </a>
</div>

<table class="problem" width="100%">
{if count($services_critical_acknowledged) gt 0 }
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="{ajax_update update_id="services_problem" function="display_table_services" params="view=services_critical_acknowledged"}" href="#"> {$services_critical_acknowledged|@count} Acknowledged </a></td>
<tr/>
{/if} 

{if count($services_critical_disabled) gt 0 }
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="{ajax_update update_id="services_problem" function="display_table_services" params="view=services_critical_disabled"}" href="#"> {$services_critical_disabled|@count} Disabled </a></td>
<tr/>
{/if} 

{if count($services_critical_scheduled) gt 0 }
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="{ajax_update update_id="services_problem" function="display_table_services" params="view=services_critical_scheduled"}" href="#"> {$services_critical_scheduled|@count} Scheduled </a></td>
<tr/>
{/if} 

{if count($services_critical_hostdown) gt 0 }
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="{ajax_update update_id="services_problem" function="display_table_services" params="view=services_critical_hostdown"}" href="#"> {$services_critical_hostdown|@count} on Problem Hosts </a></td>
<tr/>
{/if} 

{if count($services_critical_unhandled) gt 0 }
<tr>
 <td class="services_nok"><a class="Click" onClick="{ajax_update update_id="services_problem" function="display_table_services" params="view=services_critical_unhandled"}" href="#"> {$services_critical_unhandled|@count} Unhandled </a></td>
<tr/>
{/if} 
</table>
</td>

<td width="130" valign="top">
<div class="count">
 	<a class="Click" onClick="{ajax_update update_id="services_problem" function="display_table_services" params="view=services_warning"}" href="#"> {$services_warning|@count} Warning </a>
</div>

<table class="problem" width="100%">
{if count($services_warning_acknowledged) gt 0 }
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="{ajax_update update_id="services_problem" function="display_table_services" params="view=services_warning_acknowledged"}" href="#"> {$services_warning_acknowledged|@count} Acknowledged </a></td>
<tr/>
{/if} 

{if count($services_warning_disabled) gt 0 }
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="{ajax_update update_id="services_problem" function="display_table_services" params="view=services_warning_disabled"}" href="#"> {$services_warning_disabled|@count} Disabled </a></td>
<tr/>
{/if} 

{if count($services_warning_scheduled) gt 0 }
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="{ajax_update update_id="services_problem" function="display_table_services" params="view=services_warning_scheduled"}" href="#"> {$services_warning_scheduled|@count} Scheduled </a></td>
<tr/>
{/if} 

{if count($services_warning_hostdown) gt 0 }
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="{ajax_update update_id="services_problem" function="display_table_services" params="view=services_warning_hostdown"}" href="#"> {$services_warning_hostdown|@count} on Problem Hosts </a></td>
<tr/>
{/if} 

{if count($services_warning_unhandled) gt 0 }
<tr>
 <td class="services_warning"><a class="Click" onClick="{ajax_update update_id="services_problem" function="display_table_services" params="view=services_warning_unhandled"}" href="#"> {$services_warning_unhandled|@count} Unhandled </a></td>
<tr/>
{/if} 
</table>
</td>

<td width="130" valign="top">
<div class="count">
 	<a class="Click" onClick="{ajax_update update_id="services_problem" function="display_table_services" params="view=services_unknown"}" href="#"> {$services_unknown|@count} Unknown </a>
</div>

<table class="problem" width="100%">
{if count($services_unknown_acknowledged) gt 0 }
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="{ajax_update update_id="services_problem" function="display_table_services" params="view=services_unknown_acknowledged"}" href="#"> {$services_unknown_acknowledged|@count} Acknowledged </a></td>
<tr/>
{/if} 

{if count($services_unknown_disabled) gt 0 }
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="{ajax_update update_id="services_problem" function="display_table_services" params="view=services_unknown_disabled"}" href="#"> {$services_unknown_disabled|@count} Disabled </a></td>
<tr/>
{/if} 

{if count($services_unknown_scheduled) gt 0 }
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="{ajax_update update_id="services_problem" function="display_table_services" params="view=services_unknown_scheduled"}" href="#"> {$services_unknown_scheduled|@count} Scheduled </a></td>
<tr/>
{/if} 

{if count($services_unknown_hostdown) gt 0 }
<tr>
 <td class="services_nok_ok"><a class="Click" onClick="{ajax_update update_id="services_problem" function="display_table_services" params="view=services_unknown_hostdown"}" href="#"> {$services_unknown_hostdown|@count} on Problem Hosts </a></td>
<tr/>
{/if} 

{if count($services_unknown_unhandled) gt 0 }
<tr>
 <td class="services_unknown"><a class="Click" onClick="{ajax_update update_id="services_problem" function="display_table_services" params="view=services_unknown_unhandled"}" href="#"> {$services_unknown_unhandled|@count} Unhandled </a></td>
<tr/>
{/if} 
</table>
</td>

<td width="130" valign="top">
<div class="count">
 <div class="services_ok">
 	<a class="Click" onClick="{ajax_update update_id="services_problem" function="display_table_services" params="view=services_ok"}" href="#"> {$services_ok|@count} OK </a>
 </div>
</div>
</td>
<td width="130" valign="top">
<div class="count">
 <div class="services_pending">
 	<a class="Click" onClick="{ajax_update update_id="services_problem" function="display_table_services" params="view=services_pending"}" href="#"> {$services_pending|@count} Pending </a>
 </div>
</div>
</td>

</tr>
</table>
</div>

