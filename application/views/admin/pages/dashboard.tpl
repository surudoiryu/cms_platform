<div class='windowContent' style='float:right; position:relative; width:400px; font-size:12px; font-family:arial;'>
<table id='contentText' id='sort' style='width:400px; margin:0px; color:#FFF' cellspacing='0' cellpadding='0'>
	<thead>
	<tr class='windowHeader' >
		<td style='height:40px;'><div style='background-image:url("{$imagesUrl}admin/title_bar_left.jpg"); width:10px; height:40px; margin-left:-1px; float:left;'></div><div style='margin-top:13px;'>{$translate.update_information}</div></td>
		<td><div style='background-image:url("{$imagesUrl}admin/title_bar_right.jpg"); width:10px; height:40px; margin-right:-1px; float:right;'></div></td>
	</tr>
	</thead>
	<tbody id='contentText'>
	<tr><td>
		<br/>
		<span style='font-weight:bold; margin:10px;'>{$ses_info.title}</span><br/>
		<span style='font-decoration:italic; font-size:8px; margin:10px;'>{$ses_info.date}</span>
		<br/>
		<p id='contentText'>{$ses_info.text}</p>

		<br/>
	</td></tr>
	</tbody>
</table>
</div>

<div class='windowContent' style='width:400px; font-size:12px; font-family:arial;'>
<table id='contentText' id='sort' style='width:400px; margin:0px; color:#FFF' cellspacing='0' cellpadding='0'>
	<thead>
	<tr class='windowHeader' >
		<td style='height:40px;'><div style='background-image:url("{$imagesUrl}admin/title_bar_left.jpg"); width:10px; height:40px; margin-left:-1px; float:left;'></div><div style='margin-top:13px;'>{$translate.user_statics}</div></td>
		<td><div style='background-image:url("{$imagesUrl}admin/title_bar_right.jpg"); width:10px; height:40px; margin-right:-1px; float:right;'></div></td>
	</tr>
	</thead>
	<tbody id='contentText'>
	<tr><td style='width:200px; height:30px; padding-left:15px;'>{$translate.registerd_users}</td><td style='width:150px; font-weight:bold;'>{$cms_info.registeredUsers}</td></tr>
	<tr><td colspan='2'><hr></td></tr>
	<tr><td style='width:200px; height:30px; padding-left:15px;'>{$translate.banned_users}</td><td style='width:150px; font-weight:bold;'>{$cms_info.bannedUsers}</td></tr>
	<tr><td colspan='2'><hr></td></tr>
	<tr><td style='width:200px; height:30px; padding-left:15px;'>{$translate.inactive_users}</td><td style='width:150px; font-weight:bold;'>{$cms_info.inactiveUsers}</td></tr>
	<tr><td colspan='2'><hr></td></tr>
	<tr><td style='width:200px; height:30px; padding-left:15px;'>{$translate.loggedin_users}</td><td style='width:150px; font-weight:bold;'>{$cms_info.loggedinUsers}</td></tr>
	</tbody>
</table>
<br/>
</div>


<div class='windowContent' style='width:400px; font-size:12px; font-family:arial;'>
<table id='contentText' id='sort' style='width:400px; margin:0px; color:#FFF' cellspacing='0' cellpadding='0'>
	<thead>
	<tr class='windowHeader' >
		<td style='height:40px;'><div style='background-image:url("{$imagesUrl}admin/title_bar_left.jpg"); width:10px; height:40px; margin-left:-1px; float:left;'></div><div style='margin-top:13px;'>{$translate.website_statics}</div></td>
		<td><div style='background-image:url("{$imagesUrl}admin/title_bar_right.jpg"); width:10px; height:40px; margin-right:-1px; float:right;'></div></td>
	</tr>
	</thead>
	<tbody id='contentText'>
	<tr><td style='width:200px; height:30px; padding-left:15px;'>{$translate.total_pages}</td><td style='width:150px; font-weight:bold;'>{$cms_info.totalPages}</td></tr>
	<tr><td colspan='2'><hr></td></tr>
	<tr><td style='width:200px; height:30px; padding-left:15px;'>{$translate.total_comments}</td><td style='width:150px; font-weight:bold;'>{$cms_info.totalComments}</td></tr>
	<tr><td colspan='2'><hr></td></tr>
	<tr><td style='width:200px; height:30px; padding-left:15px;'>{$translate.last_comment}</td><td style='width:150px; font-weight:bold;'>{if is_array($cms_info.lastComment)}{$cms_info.lastComment.comment_text}{else}-Geen Comments-{/if}</td></tr>
	</tbody>
</table>
<br/>
</div>



<div class='windowContent' style='width:400px; font-size:12px; font-family:arial;'>
<table id='contentText' id='sort' style='width:400px; margin:0px; color:#FFF' cellspacing='0' cellpadding='0'>
	<thead>
	<tr class='windowHeader' >
		<td style='height:40px;'><div style='background-image:url("{$imagesUrl}admin/title_bar_left.jpg"); width:10px; height:40px; margin-left:-1px; float:left;'></div><div style='margin-top:13px;'>{$translate.cms_information}</div></td>
		<td><div style='background-image:url("{$imagesUrl}admin/title_bar_right.jpg"); width:10px; height:40px; margin-right:-1px; float:right;'></div></td>
	</tr>
	</thead>
	<tbody id='contentText'>
	<tr><td style='width:200px; height:30px; padding-left:15px;'>{$translate.cms_version}</td><td style='width:150px; font-weight:bold;'>{$cms_info.cmsVersion}</td></tr>
	<tr><td colspan='2'><hr></td></tr>
	<tr><td style='width:200px; height:30px; padding-left:15px;'>{$translate.cms_code}</td><td style='width:150px; font-weight:bold;'>{$cms_info.cmsCode}</td></tr>
	</tbody>
</table>
<br/>
</div>

