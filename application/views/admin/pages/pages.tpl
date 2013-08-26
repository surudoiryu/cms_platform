{nocache}
{assign var=ses_defines value=$this->session->userdata('user_session')}
{if isset($segment_array.editpage)}
<div class='windowContent' style='width:870px; font-size:12px; font-family:arial;'>
<form action='{$base_url_be}pages/editpage/{$segment_array.editpage}' method='post'>
	<table id='sort' style='width:870px; margin:0px; color:#FFF' cellspacing='0' cellpadding='0'>
	<thead>
	<tr class='windowHeader' >
		<td style='height:40px;'><div style='background-image:url("{$imagesUrl}admin/title_bar_left.jpg"); width:10px; height:40px; margin-left:-1px; float:left;'></div><div style='margin-top:13px;'>Pagina bewerken: {$webPages.page_name}</div></td>
		<td><div style='background-image:url("{$imagesUrl}admin/title_bar_right.jpg"); width:10px; height:40px; margin-right:-1px; float:right;'></div></td>
	</tr>
	</thead>
	<tbody>
	<tr><td colspan='2'><div style='color: red; font-weight:bold; margin-left:20px;'>{validation_errors()}</div></td></tr>
	{if isset($segment_array.subpage)}
		<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Pagina naam:</td><td><input name='editsubpage_name' id='editsubpage_name' type='text' maxlength='50' value="{$webContent.subpage_name|stripslashes}" style='width: 294px; margin-top:15px;' /></td></tr>
		<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Onderdeel van:</td><td><select name='editpage_parent' id='editpage_parent' style='width: 300px;'><option value=0>-Nieuwe Pagina-</option>{foreach $allPages as $page => $value}<option value='{$value.id}' {if $segment_array.editpage == $value.id}selected='selected'{/if}>{$value.page_name}</option>{/foreach}</select></td></tr>
	{else}
		<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Pagina naam:</td><td><input name='editpage_name' id='editpage_name' type='text' maxlength='50' value='{$webPages.page_name}' style='width: 294px; margin-top:15px;' /></td></tr>
		<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Onderdeel van:</td><td><select name='editpage_parent' id='editpage_parent' style='width: 300px;'><option value=0>-Nieuwe Pagina-</option>{foreach $allPages as $page => $value}<option value='{$value.id}'>{$value.page_name}</option>{/foreach}</select></td></tr>
	{/if}
	<tr><td style='width:200px; color: #000000; padding-left:15px; vertical-align:top;'>Inhoud:</td><td><textarea name='editpage_text' id='editpage_text'>{$webContent.content_text|htmlentities}</textarea></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Informatie:</td><td><input name='editpage_info' id='editpage_info' type='text' maxlength='50' value='{$webContent.content_info}' style='width: 294px;' /></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Pagina toegang:</td><td><select name='editpage_restriction' id='editpage_restriction' style='width: 300px;'>{foreach $userLevels as $level => $value}<option value='{$value.userlevel_level}' {if $webPages.page_restriction == $value.userlevel_level}selected='selected'{/if}>{$value.userlevel_name}</option>{/foreach}</select></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Menu positie:</td><td><select name='editpage_menu' id='editpage_menu' style='width: 300px;'><option value='1' {if $webPages.page_menu == '1'}selected='selected'{/if}>Boven menu</option><option value='0' {if $webPages.page_menu == '0'}selected='selected'{/if}>Onder menu</option><option value='-1' {if $webPages.page_menu == '-1'}selected='selected'{/if}>Geen menu</option></select></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'><input type='hidden' name='content_id' id='content_id' value='{$webContent.0}'><input type='hidden' name='editpage_user' id='editpage_user' value='{$ses_defines.userid}'><input type='hidden' name='editpage_date' id='editpage_date' value='{$date}'><input type='hidden' name='editpage_id' id='editpage_id' value='{$segment_array["editpage"]}'><input type='hidden' name='editsubpage_id' id='editsubpage_id' value='{$segment_array.subpage}'></td><td align='right'><input name='edit_page' id='edit_page' type='submit' value='Update pagina' /></td></tr>
	</tbody>
	</table>
	</form>
</div>
{elseif isset($segment_array.createpage)}
<div class='windowContent' style='width:870px; font-size:12px; font-family:arial;'>
<form action='{$base_url_be}pages/createpage/new' method='post'>
	<table id='sort' style='width:870px; margin:0px; color:#FFF' cellspacing='0' cellpadding='0'>
	<thead>
	<tr class='windowHeader'>
		<td style='height:40px;'><div style='background-image:url("{$imagesUrl}admin/title_bar_left.jpg"); width:10px; height:40px; margin-left:-1px; float:left;'></div><div style='margin-top:13px;'>Creeer een nieuwe pagina</div></td>
		<td><div style='background-image:url("{$imagesUrl}admin/title_bar_right.jpg"); width:10px; height:40px; margin-right:-1px; float:right;'></div></td>
	</tr>
	</thead>
	<tbody>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px; padding-top:15px;'>Pagina naam:</td><td><input name='createpage_name' id='createpage_name' type='text' maxlength='50' value='' style='width: 294px; margin-top:15px;' /></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Onderdeel van:</td><td><select name='createpage_parent' id='createpage_parent' style='width: 300px;'><option value=0>-Nieuwe Pagina-</option>{foreach $webPages as $page => $value}<option value='{$value.id}'>{$value.page_name}</option>{/foreach}</select></td></tr>
	<tr><td style='width:200px; color: #000000; padding-left:15px; vertical-align:top;'>Inhoud:</td><td><textarea name='createpage_text' id='createpage_text'></textarea></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Informatie:</td><td><input name='createpage_info' id='createpage_info' type='text' maxlength='50' value='' style='width: 294px;' /></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Pagina toegang:</td><td><select name='createpage_restriction' id='createpage_restriction' style='width: 300px;'>{foreach $userLevels as $level => $value}<option value='{$value.userlevel_level}'>{$value.userlevel_name}</option>{/foreach}</select></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Menu positie:</td><td><select name='createpage_menu' id='createpage_menu' style='width: 300px;'><option value='1'>Boven menu</option><option value='0'>Onder menu</option><option value='-1'>Geen menu</option></select></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px; '><input type='hidden' name='createpage_user' id='createpage_user' value='{$ses_defines.userid}' ><input type='hidden' name='createpage_date' id='createpage_date' value='{$date}'></td><td style=' color:black;'><input name='create_page' id='create_page' type='submit' value='Maak nieuwe pagina' style='width: 300px;' /> Let op! Met deze knop slaat u alle gemaakte aanpassingen op deze pagina op.</td></tr>
	</tbody>
	</table>
</form>
</div>
{else}
<script type="text/javascript"> 
// When the document is ready set up our sortable with it's inherant function(s) 
{literal}
$(document).ready(function() {

	var fixHelper = function(e, ui) {
		ui.children().each(function() {
			$(this).width($(this).width());
		});
		return ui;
	};
	var order	=	"";
	var teller	=	0;
    $("#sort tbody").sortable({
		helper : fixHelper,
		handle : '.handle',
		update : function() {
			$('[name^="moveRow_"]').each(function(){
				teller += 1;
				var splitThis	=	 $(this).attr('name').split('_');
				order += teller+'='+splitThis[1]+'&';
			});
			update(order);
			order = "";
			teller = 0;
      }
    });
	function update(order){
		$.ajax({
			type: 'POST',
			url: "{/literal}{$base_url_be}{literal}ajax/updatePages/",
			data: order,
			success: function(responseData){
				//alert(responseData);
			}
		});
	}
}); 
{/literal}
</script>

<div style='cursor:pointer; width:150px;'><div style='margin-left:20px; margin-top:20px;'><a href='{$base_url_be}pages/createpage/new'><img src='{$imagesUrl}icons/page_add.jpg' alt='Voeg nieuwe pagina toe' border=0 /></a></div><div style='position:absolute;margin-left:60px; margin-top:-35px;text-decoration:underline; color:#505050; font-size:12px; font-family:arial;'><a href='{$base_url_be}pages/createpage/new'>Voeg nieuwe pagina toe</a></div></div>
<div class='windowContent' style='width:870px; font-size:12px; font-family:arial;'>
	<table id='sort' style='width:870px; margin:0px; color:#FFF' cellspacing='0' cellpadding='0'>
	<thead>
	<tr class='windowHeader' >
		<td style='width:100px; height:40px;'><div style='background-image:url("{$imagesUrl}admin/title_bar_left.jpg"); width:10px; height:40px; margin-left:-1px; float:left;'></div><div style='margin-top:13px;'>Rank</div></td>
		<td style='width:150px'>Naam</td>
		<td style='width:200px'>Voorbeeld</td>
		<td style='width:125px'>Menu Positie</td>
		<td style='width:76px'>Restrictie</td>
		<td style='width:78px'>edit</td>
		<td style='width:78px'><div style='background-image:url("{$imagesUrl}admin/title_bar_right.jpg"); width:10px; height:40px; margin-right:-1px; float:right;'></div><div style='margin-top:13px;'>delete</div></td>
	</tr>
	</thead>
	<tbody>
	<!-- PAGES -->
	{foreach $webPages as $page => $value}
	{cycle values="#FFFFFF,#D2EEFF" assign="tableColor"}
	<tr style='color: #505050; cursor:pointer; background-color: {$tableColor}' id='{$value.id}' name='moveRow_{$value.id}' onMouseOut="this.style.backgroundColor='{$tableColor}'">
		<td class="handle" style='width:50px; height:30px; font-weight:bold; '><div style='background-image:url("{$imagesUrl}admin/row_left.gif"); height:30px; width:8px; float:left;'></div><div style='padding-left:5px; padding-top:8px;'><img src="{$imagesUrl}icons/drag.gif" alt="move" width="12px" height="18px" id='child_{$value.id}' style='display:none;' />{$value.page_weight}</div></td>
		<td class="handle">{$value.page_name}</td>
		<td class="handle">.../{$value.page_link}</td>
		<td class="handle">{if $value.page_menu == -1}Ontzichtbaar{elseif $value.page_menu == 0}Onderin{elseif $value.page_menu == 1}Bovenin{else}N.A.{/if}</td>
		<td class="handle">{foreach $userLevels as $level => $levelvalue}{if $levelvalue.userlevel_level == $value.page_restriction}{$levelvalue.userlevel_name}{/if}{/foreach}</td>
		<td style='width:30px;'><a href='{$base_url_be}pages/editpage/{$page}'><img src='{$imagesUrl}icons/page_alter.gif' style='padding-top:4px;' border=0></a></td>
		<td style='width:30px;'><a href='#' class='delete_button' id='pages_{$page}'><img src='{$imagesUrl}icons/page_delete.gif' style='padding-top:6px;' name="deletePage_{$value.id}" border=0></a><div style='background-image:url("{$imagesUrl}admin/row_right.gif"); height:30px; width:8px; float:right;'></div></td>
	</tr>
	<!-- SUB PAGES -->
		{foreach $subpages as $subpage => $subvalue}
			{if $subvalue.subpage_parent == $value.id}
			{cycle values="#FFFFFF,#D2EEFF" assign="tableColor"}
			<tr style='color: #505050; cursor:pointer; background-color: {$tableColor}' name='moveRow_{$value.id}-{$subvalue.id}' onMouseOut="this.style.backgroundColor='{$tableColor}'">
				<td class="handle" style='width:50px; height:30px; font-weight:bold; padding-top:0px;'><div style='background-image:url("{$imagesUrl}admin/row_left.gif"); height:30px; width:8px; float:left;'></div><div style='padding-top:8px; padding-left:50px;'><img src="{$imagesUrl}icons/drag.gif" alt="move" width="12px" height="18px" id='child_{$value.id}-{$subvalue.id}' style='display:none;' />{$subvalue.subpage_weight}</div></td>
				<td class="handle" style='text-indent: 20px;'> - {$subvalue['subpage_name']}</td>
				<td class="handle">.../{$value['page_link']}/{$subvalue['subpage_link']}</td>
				<td class="handle">{if $subvalue.page_menu == -1}Ontzichtbaar{elseif $subvalue.page_menu == 0}Onderin{elseif $subvalue.page_menu == 1}Bovenin{else}N.A.{/if}</td>
				<td class="handle">{foreach $userLevels as $level => $levelvalue}{if $levelvalue.userlevel_level == $subvalue.subpage_restriction}{$levelvalue.userlevel_name}{/if}{/foreach}</td>
				<td style='width:30px;'><a href='{$base_url_be}pages/editpage/{$page}/subpage/{$subvalue.id}'><img src='{$imagesUrl}icons/page_alter.gif'style='padding-top:4px;' border=0></a></td>
				<td style='width:30px;'><a href='#' class='delete_button' id='pages_{$page}'><img src='{$imagesUrl}icons/page_delete.gif' style='padding-top:6px;' name="deletePage_{$value.id}-{$subvalue.id}" border=0></a><div style='background-image:url("{$imagesUrl}admin/row_right.gif"); height:30px; width:8px; float:right;'></div></td>
			</tr>
			{/if}
		{/foreach}
	{/foreach}
	</tbody>
	</table>
</div>
{/if}
{/nocache}