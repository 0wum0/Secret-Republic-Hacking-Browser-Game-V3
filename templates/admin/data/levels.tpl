{include file="header_home.tpl" no_sidebar="true"}

{include "admin/data/data_header.tpl"}
<table class="table table-striped" >
 
  {for $index = 1 to 400}
   <tr> 
      <td>LEV {$index}</td>
      <td>{$levels[$index].exp|floatval|number_format} exp</td>
      <td>{$levels[$index].energy|floatval|number_format} energy</td>
     </tr>
  {/for}
 
</table>
			
				
	
		