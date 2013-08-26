{nocache}

{if isset($segment_array.upload)}

<script type="text/javascript">
	window.onload = function() {
		alert('start upload');
		fileManager_Upload("{$this->session->userdata('session_id')}");
	}
</script>


<div class='windowContent' style='width:870px; font-size:12px; font-family:arial;'>

<form id="uploadForm" action="{$base_url_be}filemanager/upload/new" method="post" enctype="multipart/form-data">
<table id='sort' style='width:870px; margin:0px; color:#FFF' cellspacing='0' cellpadding='0'>
	<thead>
	<tr class='windowHeader'>
		<td style='height:40px;'><div style='background-image:url("{$imagesUrl}admin/title_bar_left.jpg"); width:10px; height:40px; margin-left:-1px; float:left;'></div><div style='margin-top:13px;'>Upload Bestanden</div></td>
		<td><div style='background-image:url("{$imagesUrl}admin/title_bar_right.jpg"); width:10px; height:40px; margin-right:-1px; float:right;'></div></td>
	</tr>
	</thead>
	<tbody style='color: #000;'>
	<tr><td colspan='2' style='padding-top:10px; padding-left:10px;'>
		<div class="fieldset flash" id="fsUploadProgress">
			<span class="legend">Upload wachtrij</span>
		</div>
	</td></tr>
	<tr><td colspan='2'><div id="divStatus" style='margin-left:15px;'>0 Bestanden Geupload</div></td></tr>
	<tr><td style='width:100px; color: #000000; height:29px; padding-left:15px;'>
			<div id="spanButtonPlaceHolder"></div>
		</td><td>
			<input id="btnCancel" type="button" value="Stop met uploaden" onclick="swfu.cancelQueue();" disabled="disabled" style="font-size: 8pt; height: 31px; margin-left:5px; " />
	</td></tr>
	<tr><td style='height:10px;' colspan='2'>&nbsp;</td></tr>
	</tbody>
	</table>
</form>
</div>
{else}

<div style='width:100%;'><div style='float:right; width:200px; margin-right:10px;'><div style='float:left; text-decoration:underline; font-size:12px; margin-right:10px; margin-top:10px; color: #000;' >Weergave:</div><form method='POST'><input type='submit' name='detail' value='' style='border: 0px; float:left;cursor:pointer; background: #FFFFFF url("{$imagesUrl}icons/filemanager_viewbuttons.jpg") 0px {if $view == 'detail' || $view == ''}-40{else}0{/if}px no-repeat; width:40px; height:40px;' /><input type='submit' name='overview' value='' style='border:0px; float:left;cursor:pointer;  background: #FFFFFF url("{$imagesUrl}icons/filemanager_viewbuttons.jpg") -40px {if $view == 'overview'}-40{else}0{/if}px no-repeat; width:40px; height:40px;' /><input type='submit' name='thumbnail' value='' style='border:0px; float:left;cursor:pointer;  background: #FFFFFF url("{$imagesUrl}icons/filemanager_viewbuttons.jpg") -80px {if $view == 'thumbnail'}-40{else}0{/if}px no-repeat; width:40px; height:40px;' /></form></div>{if $segment_array.admin != 'ungahbrowser'}<div style='margin-left:20px; margin-top:20px;'><a href='{$base_url_be}filemanager/upload/new'><img src='{$imagesUrl}icons/file_add.jpg' alt='Voeg nieuw bestand toe' /></a></div><div style='position:absolute;margin-left:60px; margin-top:-35px;text-decoration:underline; color:#505050; font-size:12px; font-family:arial;'><a href='{$base_url_be}filemanager/upload/new'>Voeg nieuw bestand toe</a></div>{else}<div style="margin-left:30px; margin-top:30px; clear:both;">&nbsp;</div>{/if}</div>
<div class='windowContent' style='width:870px; font-size:12px; font-family:arial;'>
   <table id='sort' style='width:870px; margin:0px; color:#FFF' cellspacing='0' cellpadding='0'>
	<thead>
	<tr class='windowHeader' >
		<td style='width:180px; height:40px;' colspan='6'><div style='background-image:url("{$imagesUrl}admin/title_bar_left.jpg"); width:10px; height:40px; margin-left:-1px; float:left;'></div><div style='margin-top:13px;'>Filemanager</div></td>
		<td style='width:650px'><div style='background-image:url("{$imagesUrl}admin/title_bar_right.jpg"); width:10px; height:40px; margin-right:-1px; float:right;'></div></td>
	</tr>
	</thead>
	<tbody>
	<tr>
	{if $segment_array.admin != 'ungahbrowser'}
	<td style='border-right:1px solid #505050; width:150px; vertical-align:top; height:400px; padding-left:10px; padding-top:10px; background: #ffffff url("{$imagesUrl}admin/bg_users.jpg") no-repeat bottom; color:#505050;' rowspan='{$allUsers|count}'>
		<div class="personPopupTrigger" style='margin-bottom:10px;'><span {if !isset($segment_files.filemanager)}style='font-weight:bold;'{else}style='cursor:pointer;' onClick="document.location = '{$base_url_be}filemanager'"{/if}>Alle bestanden</span><span style='float:right;margin-right:10px;'>({$allFiles|count})<span></div>
		<div style='margin-bottom:10px;'><span {if $segment_files.filemanager == 'images'}style='font-weight:bold;'{else}style='cursor:pointer;' onClick="document.location = '{$base_url_be}filemanager/images'"{/if}>Afbeeldingen</span><span style='float:right;margin-right:10px;'>({$imageFiles|count})<span></div>
		<div style='margin-bottom:10px;'><span {if $segment_files.filemanager == 'film'}style='font-weight:bold;'{else}style='cursor:pointer;' onClick="document.location = '{$base_url_be}filemanager/film'"{/if}>Filmbestanden</span><span style='float:right;margin-right:10px;'>({$filmFiles|count})<span></div>
		<div style='margin-bottom:10px;'><span {if $segment_files.filemanager == 'flash'}style='font-weight:bold;'{else}style='cursor:pointer;' onClick="document.location = '{$base_url_be}filemanager/flash'"{/if}>Flashbestanden</span><span style='float:right;margin-right:10px;'>({$flashFiles|count})<span></div>
		<div style='margin-bottom:10px;'><span {if $segment_files.filemanager == 'text'}style='font-weight:bold;'{else}style='cursor:pointer;' onClick="document.location = '{$base_url_be}filemanager/text'"{/if}>Tekstbestanden</span><span style='float:right;margin-right:10px;'>({$textFiles|count})<span></div>
		<div style='margin-bottom:10px;'><span {if $segment_files.filemanager == 'other'}style='font-weight:bold;'{else}style='cursor:pointer;' onClick="document.location = '{$base_url_be}filemanager/other'"{/if}>Overige bestanden</span><span style='float:right;margin-right:10px;'>({$otherFiles|count})<span></div>
	</td>
	{else}
	<td style='border-right:1px solid #505050; vertical-align:top; height:400px; padding-left:10px; padding-top:10px; background: #ffffff url("{$imagesUrl}admin/bg_users.jpg") no-repeat bottom; color:#505050;' rowspan='{$allUsers|count}'>
		<div class="personPopupTrigger" style='margin-bottom:10px;'><span style='font-weight:bold;'>{$segment_array.admin}</span><span style='float:right;margin-right:10px;'>({$allFiles|count})<span></div>
	</td>
	{/if}
	<td style='vertical-align:top;' colspan='6'>
	
	<!-- All Files -->
	<div style='height:500px; overflow-y:scroll;'>
	{if $segment_files.filemanager == 'images' || $filter == 'images'}
		<!-- images -->
		{assign var=allFiles value=$imageFiles}
	{elseif $segment_files.filemanager == 'film' || $filter == 'films'}
		<!-- films -->
		{assign var=allFiles value=$filmFiles}
	{elseif $segment_files.filemanager == 'flash' || $filter == 'flash'}
		<!-- flash -->
		{assign var=allFiles value=$flashFiles}
	{elseif $segment_files.filemanager == 'text' || $filter == 'text'}
		<!-- text -->
		{assign var=allFiles value=$textFiles}
	{elseif $segment_files.filemanager == 'other' || $filter == 'other'}
		<!-- other -->
		{assign var=allFiles value=$otherFiles}
	{else}
		<!-- all -->
		{assign var=allFiles value=$allFiles}
	{/if}

	{if $view == 'detail' || $view == ''}
	<!-- Detail View -->
	{nocache}
		{foreach from=$allFiles  name=file item=value}
		{assign var=attributes value=$this->common_lib->fileAttributes($value)}
		{cycle values="#FFFFFF,#D2EEFF" assign="tableColor"}
		<table name='moveRow_{$value|replace:'.':'_'}' style='width:100%;' cellspacing='0px' cellpadding='0px'>
		<tr style='color: #505050; cursor:pointer; background-color: {$tableColor}' onMouseOver="this.style.backgroundColor='#85C6ED'" onMouseOut="this.style.backgroundColor='{$tableColor}'">
			<td style='width:150px; height:30px; '><div style='background-image:url("{$imagesUrl}admin/row_left.gif"); height:30px; width:8px; float:left;'></div><div style='padding-left:5px; padding-top:8px;'><span name='fileSpan_{$value}'>{$attributes.name|truncate:30}</span></div></td>
			<td style='width:50px'>{$attributes.type|upper}</td>
			<td style='width:80px'>{$attributes.size}</td>
			<td style='width:150px'>{$attributes.updated}</td>
			<td style='width:100px'>{$attributes.dimension}</td>
			<td style='width:50px'>
				<div style='background-image:url("{$imagesUrl}admin/row_right.gif"); height:30px; width:8px; float:right;'></div>
				<div id='child_{$value|replace:'.':'_'}' style='display: none;'>
					<div style='float:right; margin-top:7px;'>
					{if $segment_array.admin != 'ungahbrowser'}
						<img src='{$imagesUrl}icons/file_delete.gif' name="deleteFile_{$value}" border=0 style='margin-top:2px;'>
					</div>
					<div style='float:right; margin-top:7px; margin-right:5px;'>
						<img src='{$imagesUrl}icons/file_alter.gif' name="editFile_{$value}" border=0 style='margin-top:2px;'>
					{else}
						<span style="cursor:pointer;" onClick="FileBrowserDialogue.useFile('{$uploadsUrl}{$filter}/{$value}');">insert</span>
					{/if}
					</div>
				</div>
			</td>
		</tr>
		</table>
		{/foreach}
	{/nocache}
	<!-- End Detail View -->
	{elseif $view == 'overview'}
	<!-- Overview View -->
	{foreach from=$allFiles  name=file item=value}
		{assign var=attributes value=$this->common_lib->fileAttributes($value)}
		{cycle values="#FFFFFF,#FFFFFF" assign="tableColor"}
		<table name='moveRow_{$value|replace:'.':'_'}' style='width:210px; float:left;' cellspacing='0px' cellpadding='0px'>
			<tr style='color: #505050; cursor:pointer; background-color: {$tableColor}' onMouseOver="this.style.backgroundColor='#85C6ED'" onMouseOut="this.style.backgroundColor='{$tableColor}'">
				<td style='width:8px; height:30px; '><div style='background-image:url("{$imagesUrl}admin/row_left.gif"); height:30px; width:8px; float:left;'></div></td>
				<td style='width:194px; height:30px; '>
					<div style='padding-left:5px; padding-top:8px;'><span name='fileSpan_{$value}'>{$attributes.name|truncate:25}</span>.{$attributes.type|upper}   
						<div id='child_{$value|replace:'.':'_'}' style='display: none;'>
							{if $segment_array.admin != 'ungahbrowser'}
								<div style='float:right; margin-top:-18px;'>
									<img src='{$imagesUrl}icons/file_delete.gif' name="deleteFile_{$value}" border=0 style='margin-top:2px;'>
								</div>
								<div style='float:right; margin-top:-18px; margin-right:15px;'>
									<img src='{$imagesUrl}icons/file_alter.gif' name="editFile_{$value}" border=0 style='margin-top:2px;'>
								</div>
							{else}
								<div style='float:right; margin-top:-15px;'><span style="cursor:pointer;" onClick="FileBrowserDialogue.useFile('{$uploadsUrl}{$filter}/{$value}');">insert</span></div>
							{/if}
						</div>
					</div>  
				</td>
				<td style="width:8px;"><div style='background-image:url("{$imagesUrl}admin/row_right.gif"); height:30px; width:8px; float:right;'></div></td>
			</tr>
		</table>
	{/foreach}
	<!-- End Overview View -->
	{elseif $view == 'thumbnail'}
	<!-- Thumbnail View -->
	<div style='margin:20px; text-align:center;'>
	{foreach from=$allFiles  name=file item=value}
		{assign var=attributes value=$this->common_lib->fileAttributes($value)}
		{cycle values="#FFFFFF,#FFFFFF" assign="tableColor"}
		<table name='staticRow_{$value|replace:'.':'_'}' style='background-color: #FFF; margin-top:10px; width:175px; float:left;' cellspacing='0px' cellpadding='0px'>
			<tr style='color: #505050; cursor:pointer;'>
				<td style='width:194px; height:30px; '>
					<div>
						{if $attributes.type|lower == 'jpg' || $attributes.type|lower == 'jpeg' || $attributes.type|lower == 'png' || $attributes.type|lower == 'gif' || $attributes.type|lower == 'bmp'}
							<div style='abolsute;'><img src='{$uploadsUrl}images/{$value}' alt='{$attributes.name}' title='{$attributes.name}' width='120px' height='120px;' /></div>
						{elseif $attributes.type|lower == 'ico' || $attributes.type|lower == 'tiff' || $attributes.type == 'tif'}
							{* All image filetypes go here. *}
							<div style='abolsute;'><img src='{$imagesUrl}admin/image_thumb.jpg' alt='{$attributes.name}' title='{$attributes.name}' width='120px' height='120px;' /></div>
						{elseif $attributes.type|lower == 'avi' || $attributes.type|lower == 'mpg' || $attributes.type|lower == 'mpeg'}
							{* All film filetypes go here. *}
							<div style='abolsute;'><img src='{$imagesUrl}admin/film_thumb.jpg' alt='{$attributes.name}' title='{$attributes.name}' width='120px' height='120px;' /></div>
						{elseif $attributes.type|lower == 'swf'}
							{* All flash filetypes go here. *}
							<div style='abolsute;'><img src='{$imagesUrl}admin/flash_thumb.jpg' alt='{$attributes.name}' title='{$attributes.name}' width='120px' height='120px;' /></div>
						{elseif $attributes.type|lower == 'txt' || $attributes.type|lower == 'doc' || $attributes.type|lower == 'docx' || $attributes.type|lower == 'pdf'}
							{* All text filetypes go here. *}
							<div style='abolsute;'><img src='{$imagesUrl}admin/text_thumb.jpg' alt='{$attributes.name}' title='{$attributes.name}' width='120px' height='120px;' /></div>
						{else}
							{* All other filetypes go here. *}
							<div style='abolsute;'><img src='{$imagesUrl}admin/other_thumb.jpg' alt='{$attributes.name}' title='{$attributes.name}' width='120px' height='120px;' /></div>
						{/if}
						<div style='height: 10px;'>
							<div id='child_{$value|replace:'.':'_'}' style='display: none; float:absolute;'>
								{if $segment_array.admin != 'ungahbrowser'}
									<div style='position:relative; top:-25px;'>
										<div style='margin-right: -100px;'><img src='{$imagesUrl}icons/file_delete.gif' name="deleteFile_{$value}" border=0 ></div>
										<div style='margin-top:-15px; margin-left: -100px;'><img src='{$imagesUrl}icons/file_alter.gif' name="editFile_{$value}" border=0 ></div>
									</div>
								{else}
									<div style='position:relative; top:-25px;'>
										<div style=' margin-right: -80px;'><span style="cursor:pointer;" onClick="FileBrowserDialogue.useFile('{$uploadsUrl}{$filter}/{$value}');">insert</span></div>
									</div>
								{/if}
								
							</div>
						</div>
					</div>
					<div style='text-align:center; margin-top:-10px;'><span name='fileSpan_{$value}'>{$attributes.name|truncate:25}</span>.{$attributes.type|upper}</div>  
				</td>
			</tr>
		</table>
	{/foreach}
	</div>
	<!-- End Thumbnail View -->
	{/if}
	</div>
	</td>
	</tr>
	
	</tbody>
	</table>
</div>
{/if}
{/nocache}