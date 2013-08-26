<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<html xmlns="http://www.w3.org/1999/xhtml"  xmlns:og="http://ogp.me/ns#"  xmlns:fb="https://www.facebook.com/2008/fbml"  xml:lang="nl"  lang="nl">
<head>
<title>SES Platform</title>

<script type="text/javascript" src="{$scriptUrl}jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="{$scriptUrl}jquery-ui-1.8.16.custom.min.js"></script>
<!-- <script type="text/javascript" src="{$scriptUrl}jquery.wowwindow.js"></script> -->
<script type="text/javascript" src="{$scriptUrl}tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="{$scriptUrl}adminFunctions.js"></script>
<script type="text/javascript" src="{$scriptUrl}custom-form-elements.js"></script>
<script type="text/javascript" src="{$scriptUrl}swfupload/swfupload.js"></script>
<script type="text/javascript" src="{$scriptUrl}swfupload/swfupload.queue.js"></script>
<script type="text/javascript" src="{$scriptUrl}swfupload/fileprogress.js"></script>
<script type="text/javascript" src="{$scriptUrl}swfupload/handlers.js"></script>

<link rel="stylesheet" type="text/css" href="{$styleUrl}admin/wowwindow.css"> 
<link rel="stylesheet" type="text/css" href="{$styleUrl}admin/style.css">

{nocache}
{literal}

<script type="text/javascript">
$(document).ready(function() {
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});
});
</script>
{/literal}
<script type="text/javascript">
tinyMCE.init({ldelim}
    // General options
    mode : "exact",
	elements : "editpage_text,editsubpage_text,createpage_text",
	valid_elements: "*[*]",
    theme : "advanced",
	theme_advanced_fonts : "{$standardFontsStyles}",
	content_css : "{$fontStyles}",
    plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
	forced_root_block : false,
	force_br_newlines : true,
	force_p_newlines : false,
	
	file_browser_callback : 'UngahBrowser',
	advlink_file_browser_callback : 'UngahBrowser',
	
	// Theme options
	theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
	theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
	theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
	theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,
	theme_advanced_styles : 'Open image=lightbox',

	// Skin options
	skin : "o2k7",
	skin_variant : "silver",

	relative_urls : false,
	verify_html : false,
	remove_script_host : true,
	document_base_url : "{$base_url}",
		
	// Replace values for the template plugin
	template_replace_values : {ldelim}
			username : "UngahStudios",
			staffid : "16051987"
	{rdelim}
{rdelim});

function UngahBrowser(field_name, url, type, win) {ldelim}
    //alert("Field_Name: " + field_name + " nURL: " + url + " nType: " + type + " nWin: " + win);
    
	var cmsURL = "{$base_url_be}ungahbrowser/";
    if (cmsURL.indexOf("?") < 0) {ldelim}
        cmsURL = cmsURL + type;
    {rdelim}else{ldelim}
		cmsURL = cmsURL + type;
	{rdelim}
    tinyMCE.activeEditor.windowManager.open({ldelim}
        file : cmsURL,
        title : "UngahBrowser",
        width : 930, 
        height : 650,
		resizable: "yes",
		inline: "yes",
        close_previous : "no"
    {rdelim}, {ldelim}
        window : win,
        input : field_name,
    {rdelim});
    return false;
{rdelim}
</script>
{/nocache}
</head>
<body>

<div class='wrapper'>
{include file='admin/header.tpl'}

{include file='admin/content.tpl'}
</div>
</body>
</html>