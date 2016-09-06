<div id="{$id}">
<select onchange="SmartyAjax.update('services_problem', '', 'get', 'host='+this.options[this.selectedIndex].value+'&f=display_table_services_host'); return false;">
 <option class="option" value="all" selected> </option>
{foreach key=key item=item from=$table}
 <option class="option" value="{$item.name1}">{$item.name1}</option>
{/foreach}
</select>
</div>
