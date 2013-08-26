{nocache}
{assign var="updater" value=$this->updater_lib->checkUpdate()}
</div>
<div class='windowContent' style='float:right; position:relative; width:870px; font-size:12px; font-family:arial;'>
<table id='contentText' id='sort' style='width:870px; margin:0px; color:#FFF' cellspacing='0' cellpadding='0'>
	<thead>
	<tr class='windowHeader' >
		<td style='height:40px;'><div style='background-image:url("{$imagesUrl}admin/title_bar_left.jpg"); width:10px; height:40px; margin-left:-1px; float:left;'></div><div style='margin-top:13px;'>{$translate.update_information}</div></td>
		<td><div style='background-image:url("{$imagesUrl}admin/title_bar_right.jpg"); width:10px; height:40px; margin-right:-1px; float:right;'></div></td>
	</tr>
	</thead>
	<tbody id='contentText'>
	<tr><td>
		<br/>
		<p id='contentText'>{$updater.update_text}</p>
		<br/>
	</td></tr>
	</tbody>
</table>
</div>
{/nocache}