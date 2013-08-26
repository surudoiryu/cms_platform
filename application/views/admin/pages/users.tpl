<script>
$(function()
{
  var hideDelay = 500;  
  var currentID;
  var hideTimer = null;

  // One instance that's reused to show info for the current person
  var container = $('<div id="personPopupContainer">'
      + '<table width="" border="0" cellspacing="0" cellpadding="0" align="center" class="personPopupPopup">'
      + '<tr>'
      + '   <td class="corner topLeft"></td>'
      + '   <td class="top"></td>'
      + '   <td class="corner topRight"></td>'
      + '</tr>'
      + '<tr>'
      + '   <td class="left"><div class="tuutje">&nbsp;</div>&nbsp;</td>'
      + '   <td><div id="personPopupContent"></div></td>'
      + '   <td class="right">&nbsp;</td>'
      + '</tr>'
      + '<tr>'
      + '   <td class="corner bottomLeft">&nbsp;</td>'
      + '   <td class="bottom">&nbsp;</td>'
      + '   <td class="corner bottomRight"></td>'
      + '</tr>'
      + '</table>'
      + '</div>');

  $('body').append(container);

  $('.personPopupTrigger').live('mouseenter', function()
  {
      // format of 'rel' tag: pageid,personguid
      var settings = $(this).attr('rel').split(',');
      var pageID = settings[0];
      currentID = settings[1];

      // If no guid in url rel tag, don't popup blank
      if (currentID == '')
          return;

      if (hideTimer)
          clearTimeout(hideTimer);

      var pos = $(this).offset();
      var width = $(this).width();
      container.css({
          left: (pos.left + width) + 'px',
          top: pos.top - 5 + 'px'
      });

      $('#personPopupContent').html('<div style="width:100%; text-align:center;"><img src="{$imagesUrl}admin/ajax-loader.gif" alt="loading please wait..." /></div>');
	
      $.ajax({
          type: 'POST',
          url: '{$base_url_be}ajax/getuser',
          data: 'user=' + pageID + '&guid=' + currentID,
          success: function(data)
          {
              // Verify that we're pointed to a page that returned the expected results.
              if (data == "")
              {
                  var text = '<span >Page ' + pageID + ' did not return a valid result for person ' + currentID + '.<br />Please have your administrator check the error log.</span>';
              }else{
				  var text = data;
			  }   

			$('#personPopupContent').html(text);

			container.css('display', 'block');
          }
      });
	
	  
  });

  $('.personPopupTrigger').live('mouseleave', function()
  {
      if (hideTimer)
          clearTimeout(hideTimer);
      hideTimer = setTimeout(function()
      {
          container.css('display', 'none');
      }, hideDelay);
  });

  // Allow mouse over of details without hiding details
  $('#personPopupContainer').mouseover(function()
  {
      if (hideTimer)
          clearTimeout(hideTimer);
  });

  // Hide after mouseout
  $('#personPopupContainer').mouseout(function()
  {
      if (hideTimer)
          clearTimeout(hideTimer);
      hideTimer = setTimeout(function()
      {
          container.css('display', 'none');
      }, hideDelay);
  });
});
</script>
{nocache}

{if isset($segment_array.edituser)}
<div class='windowContent' style='width:870px; font-size:12px; font-family:arial;'>
<form action='{$base_url_be}users/edituser/{$segment_array.edituser}' method='post'>
	<table id='sort' style='width:870px; margin:0px; color:#FFF' cellspacing='0' cellpadding='0'>
	<thead>
	<tr class='windowHeader' >
		<td style='height:40px;'><div style='background-image:url("{$imagesUrl}admin/title_bar_left.jpg"); width:10px; height:40px; margin-left:-1px; float:left;'></div><div style='margin-top:13px;'>Gebruiker bewerken: {$users.user_username}</div></td>
		<td><div style='background-image:url("{$imagesUrl}admin/title_bar_right.jpg"); width:10px; height:40px; margin-right:-1px; float:right;'></div></td>
	</tr>
	</thead>
	<tbody>
	<tr><td colspan='2'><div style='color: red; font-weight:bold; margin-left:20px;'>{validation_errors()}</div></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Gebruikersnaam:</td><td><input name='edituser_username' id='edituser_username' type='text' maxlength='50' value='{$users.user_username}' style='width: 294px; margin-top:15px;' /></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Wachtwoord:</td><td><input name='edituser_password' id='edituser_password' type='password' maxlength='50' value='' style='width: 294px; margin-top:15px;' /></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Gebruiker voornaam:</td><td><input name='edituser_firstname' id='edituser_firstname' type='text' maxlength='50' value='{$users.user_firstname}' style='width: 294px; margin-top:15px;' /></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Gebruiker achternaam:</td><td><input name='edituser_lastname' id='edituser_lastname' type='text' maxlength='50' value='{$users.user_lastname}' style='width: 294px; margin-top:15px;' /></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px; '>Email:</td><td><input name='edituser_email' id='edituser_email' type='text' maxlength='50' value='{$users.user_email}' style='width: 294px; margin-top:15px;' /></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Level:</td><td><select name='edituser_level' id='edituser_level' style='width: 300px;'>{foreach $userLevels as $level => $value}<option value='{$value.userlevel_level}' {if $users.user_level == $value.userlevel_level}selected='selected'{/if}>{$value.userlevel_name}</option>{/foreach}</select></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Land:</td><td><select name='edituser_land' id='edituser_land' style='width: 300px;'>{foreach $allLands as $land => $value}<option value='{$value.id}' {if $users.user_land == $value.id}selected='selected'{/if}>{$value.land_name}</option>{/foreach}</select></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Verbannen:</td><td><input type='checkbox' name='edituser_banned' id='edituser_banned' {if $users.user_banned == 1} checked='checked' {/if} /></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'><input type='hidden' name='edituser_id' id='edituser_id' value='{$segment_array["edituser"]}'></td><td align='right'><input name='edit_user' id='edit_user' type='submit' value='Update user' /></td></tr>
	</tbody>
	</table>
	</form>
</div>
{elseif isset($segment_array.createuser)}
<div class='windowContent' style='width:870px; font-size:12px; font-family:arial;'>
<form action='{$base_url_be}users/createuser/new' method='post'>
	<table id='sort' style='width:870px; margin:0px; color:#FFF' cellspacing='0' cellpadding='0'>
	<thead>
	<tr class='windowHeader'>
		<td style='height:40px;'><div style='background-image:url("{$imagesUrl}admin/title_bar_left.jpg"); width:10px; height:40px; margin-left:-1px; float:left;'></div><div style='margin-top:13px;'>Creeer een nieuwe pagina</div></td>
		<td><div style='background-image:url("{$imagesUrl}admin/title_bar_right.jpg"); width:10px; height:40px; margin-right:-1px; float:right;'></div></td>
	</tr>
	</thead>
	<tbody>
	<tr><td colspan='2'><div style='color: red; font-weight:bold; margin-left:20px;'>{validation_errors()}</div></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Gebruikersnaam:</td><td><input name='createuser_username' id='createuser_username' type='text' maxlength='50' value='' style='width: 294px; margin-top:15px;' /></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Wachtwoord:</td><td><input name='createuser_password' id='createuser_password' type='password' maxlength='50' value='' style='width: 294px; margin-top:15px;' /></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Gebruiker voornaam:</td><td><input name='createuser_firstname' id='createuser_firstname' type='text' maxlength='50' value='' style='width: 294px; margin-top:15px;' /></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Gebruiker achternaam:</td><td><input name='createuser_lastname' id='createuser_lastname' type='text' maxlength='50' value='' style='width: 294px; margin-top:15px;' /></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px; '>Email:</td><td><input name='createuser_email' id='createuser_email' type='text' maxlength='50' value='' style='width: 294px; margin-top:15px;' /></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Level:</td><td><select name='createuser_level' id='createuser_level' style='width: 300px;'>{foreach $userLevels as $level => $value}<option value='{$value.userlevel_level}'>{$value.userlevel_name}</option>{/foreach}</select></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'>Land:</td><td><select name='createuser_land' id='createuser_land' style='width: 300px;'>{foreach $allLands as $land => $value}<option value='{$value.id}'>{$value.land_name}</option>{/foreach}</select></td></tr>
	<tr><td style='width:200px; color: #000000; height:30px; padding-left:15px;'></td><td align='right'><input name='create_user' id='create_user' type='submit' value='Create user' /></td></tr>
	</tbody>
	</table>
</form>
</div>
{else}
<div style='cursor:pointer; width:150px;'><div style='margin-left:20px; margin-top:20px;'><a href='{$base_url_be}users/createuser/new'><img src='{$imagesUrl}icons/user_add.jpg' alt='Voeg nieuwe gebruiker toe' /></a></div><div style='position:absolute;margin-left:60px; margin-top:-35px;text-decoration:underline; color:#505050; font-size:12px; font-family:arial;'><a href='{$base_url_be}users/createuser/new'>Voeg nieuwe gebruiker toe</a></div></div>
<div class='windowContent' style='width:870px; font-size:12px; font-family:arial;'>
   <table id='sort' style='width:870px; margin:0px; color:#FFF' cellspacing='0' cellpadding='0'>
	<thead>
	<tr class='windowHeader' >
		<td style='width:180px; height:40px;'><div style='background-image:url("{$imagesUrl}admin/title_bar_left.jpg"); width:10px; height:40px; margin-left:-1px; float:left;'></div><div style='margin-top:13px;'>users</div></td>
		<td style='width:150px'>Gebruikersnaam</td>
		<td style='width:150px'>Volledige naam</td>
		<td style='width:150px'>Email</td>
		<td style='width:76px'>Rang</td>
		<td style='width:78px'>edit</td>
		<td style='width:75px'><div style='background-image:url("{$imagesUrl}admin/title_bar_right.jpg"); width:10px; height:40px; margin-right:-1px; float:right;'></div><div style='margin-top:13px;'>delete</div></td>
	</tr>
	</thead>
	<tbody>
	<tr>
	<td style='border-right:1px solid #505050; vertical-align:top; height:400px; padding-left:10px; padding-top:10px; background: #ffffff url("{$imagesUrl}admin/bg_users.jpg") no-repeat bottom; color:#505050;' rowspan='{$allUsers|count}'>
		<div class="personPopupTrigger" style='margin-bottom:10px;'><span {if !isset($segment_user.users)}style='font-weight:bold;'{else}style='cursor:pointer;' onClick="document.location = '{$base_url_be}users'"{/if}>Alle gebruikers</span><span style='float:right;margin-right:10px;'>({$allUsers|count})<span></div>
		<div style='margin-bottom:10px;'><span {if $segment_user.users == 'blocked'}style='font-weight:bold;'{else}style='cursor:pointer;' onClick="document.location = '{$base_url_be}users/blocked'"{/if}>Geblokeerd</span><span style='float:right;margin-right:10px;'>({$bannedUsers|count})<span></div>
		<div style='margin-bottom:10px;'><span {if $segment_user.users == 'inactive'}style='font-weight:bold;'{else}style='cursor:pointer;' onClick="document.location = '{$base_url_be}users/inactive'"{/if}>Inactief</span><span style='float:right;margin-right:10px;'>({$inactiveUsers|count})<span></div>
		<div style='margin-bottom:10px;'><span {if $segment_user.users == 'loggedin'}style='font-weight:bold;'{else}style='cursor:pointer;' onClick="document.location = '{$base_url_be}users/loggedin'"{/if}>Ingelogd</span><span style='float:right;margin-right:10px;'>({$loggedinUsers|count})<span></div>
	</td>
	<td style='vertical-align:top;' colspan='6'>
	{if !isset($segment_user.users)}
	<!-- All Users -->
	{foreach from=$allUsers  name=user item=value}
	{cycle values="#FFFFFF,#D2EEFF" assign="tableColor"}
	<table name='moveRow_{$value.id}' class="personPopupTrigger" rel="{$value.id},a17bee64-8593-436e-a2f8-599a626370df"  style='width:100%;' cellspacing='0px' cellpadding='0px'>
	<tr style='color: #505050; cursor:pointer; background-color: {$tableColor}' onMouseOver="this.style.backgroundColor='#85C6ED'" onMouseOut="this.style.backgroundColor='{$tableColor}'">
		<td style='width:150px; height:30px; '><div style='background-image:url("{$imagesUrl}admin/row_left.gif"); height:30px; width:8px; float:left;'></div><div style='padding-left:5px; padding-top:8px;'>{$value.user_username|truncate:15}</div></td>
		<td style='width:150px'>{$value.user_firstname} {$value.user_lastname|truncate:10}</td>
		<td style='width:150px'>{$value.user_email|truncate:20}</td>
		<td style='width:76px'>{if $value.user_banned == 1}<span style='color:red;'>Geblokeerd</span>{else}{$userLevels[$value.user_level+1]['userlevel_name']}{/if}</td>
		<td style='width:78px;'><a href='{$base_url_be}users/edituser/{$value.id}'><img src='{$imagesUrl}icons/user_alter.gif' border=0></a></td>
		<td style='width:78px;'><img src='{$imagesUrl}icons/user_delete.gif' name="deleteUser_{$value.id}" border=0 style='margin-top:2px;'><div style='background-image:url("{$imagesUrl}admin/row_right.gif"); height:30px; width:8px; float:right;'></div></td>
	</tr>
	</table>
	{/foreach}
	{elseif $segment_user.users == 'blocked'}
	<!-- Banned Users -->
	{foreach from=$bannedUsers  name=user item=value}
	{cycle values="#FFFFFF,#D2EEFF" assign="tableColor"}
	<table name='moveRow_{$value.id}' class="personPopupTrigger" rel="{$value.id},a17bee64-8593-436e-a2f8-599a626370df" style='width:100%;' cellspacing='0px' cellpadding='0px'>
	<tr style='color: #505050; cursor:pointer; background-color: {$tableColor}' onMouseOver="this.style.backgroundColor='#85C6ED'" onMouseOut="this.style.backgroundColor='{$tableColor}'">
		<td style='width:150px; height:30px; '><div style='background-image:url("{$imagesUrl}admin/row_left.gif"); height:30px; width:8px; float:left;'></div><div style='padding-left:5px; padding-top:8px;'>{$value.user_username|truncate:15}</div></td>
		<td style='width:150px'>{$value.user_firstname} {$value.user_lastname|truncate:10}</td>
		<td style='width:150px'>{$value.user_email|truncate:20}</td>
		<td style='width:76px'>{if $value.user_banned == 1}<span style='color:red;'>Geblokeerd</span>{else}{$userLevels[$value.user_level]['userlevel_name']}{/if}</td>
		<td style='width:78px;'><a href='{$base_url_be}users/edituser/{$value.id}'><img src='{$imagesUrl}icons/user_alter.gif' border=0></a></td>
		<td style='width:78px;'><img src='{$imagesUrl}icons/user_delete.gif' name="deleteUser_{$value.id}" border=0 style='margin-top:2px;'><div style='background-image:url("{$imagesUrl}admin/row_right.gif"); height:30px; width:8px; float:right;'></div></td>
	</tr>
	</table>
	{/foreach}
	{elseif $segment_user.users == 'inactive'}
	<!-- Inactive Users -->
	{foreach from=$inactiveUsers  name=user item=value}
	{cycle values="#FFFFFF,#D2EEFF" assign="tableColor"}
	<table name='moveRow_{$value.id}' class="personPopupTrigger" rel="{$value.id},a17bee64-8593-436e-a2f8-599a626370df" style='width:100%;' cellspacing='0px' cellpadding='0px'>
	<tr style='color: #505050; cursor:pointer; background-color: {$tableColor}' onMouseOver="this.style.backgroundColor='#85C6ED'" onMouseOut="this.style.backgroundColor='{$tableColor}'">
		<td style='width:150px; height:30px; '><div style='background-image:url("{$imagesUrl}admin/row_left.gif"); height:30px; width:8px; float:left;'></div><div style='padding-left:5px; padding-top:8px;'>{$value.user_username|truncate:15}</div></td>
		<td style='width:150px'>{$value.user_firstname} {$value.user_lastname|truncate:10}</td>
		<td style='width:150px'>{$value.user_email|truncate:20}</td>
		<td style='width:76px'>{if $value.user_banned == 1}<span style='color:red;'>Geblokeerd</span>{else}{$userLevels[$value.user_level]['userlevel_name']}{/if}</td>
		<td style='width:78px;'><a href='{$base_url_be}users/edituser/{$value.id}'><img src='{$imagesUrl}icons/user_alter.gif' border=0></a></td>
		<td style='width:78px;'><img src='{$imagesUrl}icons/user_delete.gif' name="deleteUser_{$value.id}" border=0 style='margin-top:2px;'><div style='background-image:url("{$imagesUrl}admin/row_right.gif"); height:30px; width:8px; float:right;'></div></td>
	</tr>
	</table>
	{/foreach}
	{elseif $segment_user.users == 'loggedin'}
	<!-- Logged in Users -->
	{foreach from=$loggedinUsers  name=user item=value}
	{cycle values="#FFFFFF,#D2EEFF" assign="tableColor"}
	<table name='moveRow_{$value.id}' class="personPopupTrigger" rel="{$value.id},a17bee64-8593-436e-a2f8-599a626370df" style='width:100%;' cellspacing='0px' cellpadding='0px'>
	<tr style='color: #505050; cursor:pointer; background-color: {$tableColor}' onMouseOver="this.style.backgroundColor='#85C6ED'" onMouseOut="this.style.backgroundColor='{$tableColor}'">
		<td style='width:150px; height:30px; '><div style='background-image:url("{$imagesUrl}admin/row_left.gif"); height:30px; width:8px; float:left;'></div><div style='padding-left:5px; padding-top:8px;'>{$value.user_username|truncate:15}</div></td>
		<td style='width:150px'>{$value.user_firstname} {$value.user_lastname|truncate:10}</td>
		<td style='width:150px'>{$value.user_email|truncate:20}</td>
		<td style='width:76px'>{if $value.user_banned == 1}<span style='color:red;'>Geblokeerd</span>{else}{$userLevels[$value.user_level]['userlevel_name']}{/if}</td>
		<td style='width:78px;'><a href='{$base_url_be}users/edituser/{$value.id}'><img src='{$imagesUrl}icons/user_alter.gif' border=0></a></td>
		<td style='width:78px;'><img src='{$imagesUrl}icons/user_delete.gif' name="deleteUser_{$value.id}" border=0 style='margin-top:2px;'><div style='background-image:url("{$imagesUrl}admin/row_right.gif"); height:30px; width:8px; float:right;'></div></td>
	</tr>
	</table>
	{/foreach}
	{/if}
	</td>
	</tr>
	
	</tbody>
	</table>
</div>
{/if}
{/nocache}