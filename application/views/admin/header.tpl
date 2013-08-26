<div class='logo'><div style='color:gray; font-size:11px; margin-left:143px; margin-top:80px; cursor:pointer;'><a href='{$base_url_be}update'>Versie {$this->updater_lib->getCmsVersion()}{if !$this->updater_lib->updateFiles}<img src='{$imagesUrl}icons/uptodate.gif' alt='{$updater.update_version}' style='margin-left:3px; position:absolute; margin-top:1px;' />{else}<img src='{$imagesUrl}icons/outdated.gif' alt='{$updater.update_version}' style='margin-left:3px; position:absolute; margin-top:1px;' />{/if}</a></div></div>
<div class='quickmenu'>{$translate.welcome} <i>{$this->session->userdata['user_session']['username']}</i> | <a href='../' target='_blank'>{$translate.view_site}</a> | <a href='{$base_url_be}logout'>{$translate.logout}</a></div>
<div class='menu'>
	<table class='menuholder'>
	<tr>
	{foreach $pages as $page}
	<td class='menuAlign'>
		<div class='menuitemLeft'>&nbsp;</div>
		<div class='menuitem'><a href='{$base_url_be}{$page|lower}'>{$page}</a></div>
		<div class='menuitemRight'>&nbsp;</div>
	</td>
	{/foreach}
		
	</tr>
	</table>
</div>
<div id='submenu' class='submenu'>
	
</div>