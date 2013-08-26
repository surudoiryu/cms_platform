{nocache}
<div class='windowContent' style='width:870px; font-size:12px; font-family:arial;'>
   <table id='sort' style='width:870px; margin:0px; color:#FFF' cellspacing='0' cellpadding='0'>
	<thead>
	<tr class='windowHeader' >
		<td style='width:180px; height:40px;'><div style='background-image:url("{$imagesUrl}admin/title_bar_left.jpg"); width:10px; height:40px; margin-left:-1px; float:left;'></div><div style='margin-top:13px;'>Settings</div></td>
		<td><div style='background-image:url("{$imagesUrl}admin/title_bar_right.jpg"); width:10px; height:40px; margin-right:-1px; float:right;'></div><div style='margin-top:13px;'></div></td>
	</tr>
	</thead>
	<tbody>
	<tr>
	<td style='border-right:1px solid #505050; vertical-align:top; height:400px; padding-left:10px; padding-top:10px; background: #ffffff url("{$imagesUrl}admin/bg_users.jpg") no-repeat bottom; color:#505050;' rowspan='{$allUsers|count}'>
		<div class="personPopupTrigger" style='margin-bottom:10px;'><span {if !isset($segment_setting.settings)}style='font-weight:bold;'{else}style='cursor:pointer;' onClick="document.location = '{$base_url_be}settings'"{/if}>Website Settings</span></div>
		<div style='margin-bottom:10px;'><span {if $segment_setting.settings == 'seo'}style='font-weight:bold;'{else}style='cursor:pointer;' onClick="document.location = '{$base_url_be}settings/seo'"{/if}>Website SEO</span></div>
		<div style='margin-bottom:10px;'><span {if $segment_setting.settings == 'plugins'}style='font-weight:bold;'{else}style='cursor:pointer;' onClick="document.location = '{$base_url_be}settings/plugins'"{/if}>Website Plugins</span></div>
		<div style='margin-bottom:10px;'><span {if $segment_setting.settings == 'backup'}style='font-weight:bold;'{else}style='cursor:pointer;' onClick="document.location = '{$base_url_be}settings/backup'"{/if}>Website Backup</span></div>
	</td>
	<td style='vertical-align:top;' colspan='6'>
	{if !isset($segment_setting.settings)}
	<!-- Web Settings -->
	<form name='editsettings' method='POST'>
		<table style='width:100%; color: #505050; margin-left:10px; margin-top:5px;' cellspacing='0px' cellpadding='0px'>
			<tr><td style='width:250px; height:30px; '>Website Title:</td><td style='width:350px'> <input type='text' name='editsettings_title' style='width:350px' value='{$settings.setting_title}' /> </td><td style='width:50px'><img src='{$imagesUrl}icons/info.gif' alt='More information' /></td></tr>
			<tr><td style='width:250px; height:30px; '>Website Template:</td><td style='width:350px'> <select style="width:354px;" name='editsettings_template'>{foreach $templates as $template}<option value="{$template}">{$template}</option>{/foreach}</select> </td><td style='width:50px'><img src='{$imagesUrl}icons/info.gif' alt='More information' /></td></tr>
			<tr><td style='width:250px; height:30px; '>Website Mail:</td><td style='width:350px'> <input type='text' style='width:350px' name='editsettings_mail' value='{$settings.setting_email}' /> </td><td style='width:50px'><img src='{$imagesUrl}icons/info.gif' alt='More information' /></td></tr>
			<tr><td style='width:250px; height:30px; '>Website Font:</td><td style='width:350px'> <select style="width:354px;" name='editsettings_font'><option style="font-family: verdana,sans-serif;" {if $settings.setting_font == 'verdana,sans-serif'}selected="selected"{/if}>verdana,sans-serif</option><option style="font-family: arial;" {if $settings.setting_font == 'arial'}selected="selected"{/if}>arial</option><option style="font-family: zapf-chancery,cursive;" {if $settings.setting_font == 'zapf-chancery,cursive'}selected="selected"{/if}>zapf-chancery,cursive</option><option style="font-family: western,cursive;" {if $settings.setting_font == 'western,cursive'}selected="selected"{/if}>western,cursive</option><option style="font-family: courier,monospace;" {if $settings.setting_font == 'courier,monospace'}selected="selected"{/if}>courier,monospace</option><option style="font-family: helvetica,sans-serif;" {if $settings.setting_font == 'helvetica,sans-serif'}selected="selected"{/if}>helvetica,sans-serif</option><option style="font-family: times,serif;" {if $settings.setting_font == 'times,serif'}selected="selected"{/if}>times,serif</option></select> </td><td style='width:50px'><img src='{$imagesUrl}icons/info.gif' alt='More information' /></td></tr>
			<tr><td style='width:250px; height:30px; '>Enable Register:</td><td style='width:350px'> On<input type="radio" value="1" name='editsettings_register' id='setting_register' {if $settings.setting_enableregister == 1} checked='checked' {/if}> Off<input type="radio" name='editsettings_register' id='setting_register' value="0" {if $settings.setting_enableregister == 0} checked='checked' {/if}> <span style='font-size:9px; color:#333; float:right; margin-right:20px; margin-top:3px;'>(Deze optie werkt alleen als uw website hiervoor ingesteld is.)</span> </td><td style='width:50px'><img src='{$imagesUrl}icons/info.gif' alt='More information' /></td></tr>
			<tr><td style='width:250px; height:30px; '>Enable Login:</td><td style='width:350px'> On<input type="radio" value="1" name='editsettings_login' id='setting_login' {if $settings.setting_enablelogin == 1} checked='checked' {/if}> Off<input type="radio" name='editsettings_login' id='setting_login' value="0" {if $settings.setting_enablelogin == 0} checked='checked' {/if}> <span style='font-size:9px; color:#333; float:right; margin-right:20px; margin-top:3px;'>(Deze optie werkt alleen als uw website hiervoor ingesteld is.)</span> </td><td style='width:50px'><img src='{$imagesUrl}icons/info.gif' alt='More information' /></td></tr>
			<tr><td style='width:250px; height:30px; '>Enable Response:</td><td style='width:350px'> On<input type="radio" value="1" name='editsettings_response' id='setting_response' {if $settings.setting_enableresponse == 1} checked='checked' {/if}> Off<input type="radio" name='editsettings_response' id='setting_response' value="0" {if $settings.setting_enableresponse == 0} checked='checked' {/if}> <span style='font-size:9px; color:#333; float:right; margin-right:20px; margin-top:3px;'>(Deze optie werkt alleen als uw website hiervoor ingesteld is.)</span> </td><td style='width:50px'><img src='{$imagesUrl}icons/info.gif' alt='More information' /></td></tr>
			<tr><td style='width:250px; height:30px; '>Google Analytics:</td><td style='width:350px'> <input type='text' style='width:350px' name='editsettings_google' value='{$settings.setting_google}' /> </td><td style='width:50px'><img src='{$imagesUrl}icons/info.gif' alt='More information' /></td></tr>
			<tr><td style='width:250px; height:30px; '><input type='submit' name='editsettings_submit' value='Update gegevens' /></td><td style='width:350px'> Door te updaten worden uw oude instellingen veranderd.</td><td style='width:50px'></td></tr>
		</table>
	</form>
	{elseif $segment_setting.settings == 'seo'}
	<!-- Seo Settings -->
	<form name='editseo' method='POST'>
		<table style='width:100%; color: #505050; margin-left:10px; margin-top:5px;' cellspacing='0px' cellpadding='0px'>
			<tr><td style='width:250px; height:30px; '>Title Optimalisation:</td><td style='width:350px'> <select style="width:354px;" id="seo_title" name='editseo_titlesort' name="seo_title"><option value="0" {if $settings.setting_titlesort == 0} selected='selected' {/if} >Website Title</option><option value="1" {if $settings.setting_titlesort == 1} selected='selected' {/if} >Website Title | Page Name</option><option value="2" {if $settings.setting_titlesort == 2} selected='selected' {/if} >Page Name | Website Title</option><option value="3" {if $settings.setting_titlesort == 3} selected='selected' {/if} >Page Name | Page Info | Website Title</option></select> </td><td style='width:50px'><img src='{$imagesUrl}icons/info.gif' alt='More information' /></td></tr>
			<tr><td style='width:250px; height:30px; '>Website Description:</td><td style='width:350px'> <input type='text' name='editseo_description' style='width:350px' value='{$settings.setting_description}' /> </td><td style='width:50px'><img src='{$imagesUrl}icons/info.gif' alt='More information' /></td></tr>
			<tr><td style='width:250px; height:30px; '>Website Keywords:</td><td style='width:350px'> <input type='text' name='editseo_keywords' style='width:350px' value='{$settings.setting_keywords}' /> </td><td style='width:50px'><img src='{$imagesUrl}icons/info.gif' alt='More information' /></td></tr>
			<tr><td style='width:250px; height:30px; '>Website Author:</td><td style='width:350px'> <input type='text' name='editseo_author' style='width:350px' value='{$settings.setting_author}' /> </td><td style='width:50px'><img src='{$imagesUrl}icons/info.gif' alt='More information' /></td></tr>
			<tr><td style='width:250px; height:30px; '>Website Copyright:</td><td style='width:350px'> <input type='text' name='editseo_copyright' style='width:350px' value='{$settings.setting_copyright}' /> </td><td style='width:50px'><img src='{$imagesUrl}icons/info.gif' alt='More information' /></td></tr>
			<tr><td style='width:250px; height:30px; '>Website Language:</td><td style='width:350px'> <select style='width:354px' name='editseo_language'>{foreach $lands as $land}<option value='{$land.id}' {if $land.id==$settings.setting_language} selected='selected' {/if}>{$land.land_name}</option>{/foreach}</select> </td><td style='width:50px'><img src='{$imagesUrl}icons/info.gif' alt='More information' /></td></tr>
			<tr><td style='width:250px; height:30px; '>Robot Search:</td><td style='width:350px'> <select style='width:354px' name='editseo_robotsearch' id="setting_robots" name="setting_robots"><option value="none" {if $settings.setting_robots=='none'} selected='selected' {/if} >none</option><option value="noindex, nofollow" {if $settings.setting_robots=='noindex, nofollow'} selected='selected' {/if}>noindex, nofollow</option><option value="noindex, follow" {if $settings.setting_robots=='noindex, follow'} selected='selected' {/if}>noindex, follow</option><option value="index, nofollow" {if $settings.setting_robots=='index, nofollow'} selected='selected' {/if}>index, nofollow</option><option value="index, follow" {if $settings.setting_robots=='index, follow'} selected='selected' {/if}>index, follow</option><option value="all" {if $settings.setting_robots=='all'} selected='selected' {/if}>all</option></select> </td><td style='width:50px'><img src='{$imagesUrl}icons/info.gif' alt='More information' /></td></tr>
			<tr><td style='width:250px; height:30px; '>Robot Revisit:</td><td style='width:350px'> <select style='width:354px' name='editseo_robotrevisit'>{section name=days loop=30}<option value='{$smarty.section.days.iteration} day{if $smarty.section.days.iteration > 1}s{/if}' {if $smarty.section.days.iteration == $robotday} selected='selected' {/if}>{$smarty.section.days.iteration} day{if $smarty.section.days.iteration > 1}s{/if}</option>{/section}</select> </td><td style='width:50px'><img src='{$imagesUrl}icons/info.gif' alt='More information' /></td></tr>
			<tr><td style='width:250px; height:30px; '><input type='submit' name='editseo_submit' value='Update gegevens' /></td><td style='width:350px'> Door te updaten worden uw oude instellingen veranderd.</td><td style='width:50px'></td></tr>
		</table>
	</form>
	{elseif $segment_setting.settings == 'plugins'}
	<!-- Plugin Settings -->
	<form id='plugin' name='plugin' method='post'>
		<table style='width:100%; color: #505050; margin-left:10px; margin-top:5px;' cellspacing='0px' cellpadding='0px'>
			<tr><td style='width:250px; height:30px; '><b>Inactive plugins</b><img src='{$imagesUrl}icons/info.gif' style='float:right;' alt='More information' /></td>
				<td style='width:70px;'></td>
				<td><b>Active Plugins</b><img src='{$imagesUrl}icons/info.gif' style='float:right; margin-right:20px;' alt='More information' /></td>
			</tr>
			<tr>
				<td style='width:250px; height:30px; '>
				<select size='15' style="width: 300px; height:350px" name='plugin_inactivate' id='plugin_inactivate'>
					{foreach $plugins_inactive as $plugin => $control}
						<option value="{$control.id}">{$control.plugin_name}</option>
					{/foreach} 
				</select>
				</td>
				<td valign='top' style='text-align:center;'><input type='submit' id='plugin_add' name='plugin_add' value='>>>'><br><input type='submit' id='plugin_remove' name='plugin_remove' value='<<<'></td><td>
				<select size='15' style="width: 300px; height:350px" name='plugin_activate' id='plugin_activate'>
					{foreach $plugins_active as $plugin => $control}
						<option value="{$control.id}">{$control.plugin_name}</option>
					{/foreach} 
				</select>
				</td>
			</tr>
		</table>
	</form>
	{elseif $segment_setting.settings == 'backup'}
	<!-- Backup Settings -->
	<form id='database' name='database' enctype="multipart/form-data" method='post'>
		<table style='width:100%; color: #505050; margin-left:10px; margin-top:5px;' cellspacing='0px' cellpadding='0px'>
			<tr><td><input type='submit' name='database_backup' id='database_backup' value='Backup Database'>&nbsp;&nbsp;&nbsp;<input type='submit' name='database_restore' id='database_restore' value='Restore Database'></td></tr>
			<tr><td><hr style='margin-right:20px;'></td></tr>
			<tr><td>
				<select name='database_sqlfile' id='database_sqlfile' size='15' width="300" style="width: 300px">
					{foreach $dbArray as $file}
						<option value="{$file}">{$file}</option>
					{/foreach}
				</select>
			</td></tr>
		</table>
	</form>
	{/if}
	</td>
	</tr>
	
	</tbody>
	</table>
</div>

{/nocache}