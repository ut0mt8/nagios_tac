<div id="{$id}">
<table width="98%">
<tr><th colspan="6" align="left">&nbsp;:: Alerts History</th></tr>
{if (count($history) ) gt 0 }
<tr>
 <td class="table_headers"> </td>
 <td class="table_headers">Date</td>
 <td class="table_headers">HostName</td>
 <td class="table_headers">ServiceName</td>
 <td class="table_headers">Status</td>
 <td class="table_headers">Output</td>
</tr>
{foreach key=key item=item from=$history}
<tr class="output">
<td nowrap>
{if $item.status == "Warning" }
 <img height="15px" src="images/warning.png" alt="">
{/if}
{if $item.status == "Critical" or $item.status == "DOWN" or $item.status == "Unreachable" }
 <img height="15px" src="images/critical.png" alt="">
{/if}
{if $item.status == "OK" or $item.status == "UP"}
 <img height="15px" src="images/recovery.png" alt="">
{/if}
{if $item.status == "Unknown" }
 <img height="15px" src="images/unknown.png" alt="">
{/if}
</td>
 <td nowrap> {$item.state_time} </td>
 <td nowrap> {$item.name1} </td>
 <td nowrap> {$item.name2} </td>
 <td nowrap> {$item.status} </td>
 <td width="100%"> {$item.output} </td>
<tr/>
{/foreach}
{else}
<tr class="output"><td align="left"> No Alerts in history...</td></tr>
{/if}
</table>
</div>

