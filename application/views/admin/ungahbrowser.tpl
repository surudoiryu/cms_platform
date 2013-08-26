<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<html xmlns="http://www.w3.org/1999/xhtml"  xmlns:og="http://ogp.me/ns#"  xmlns:fb="https://www.facebook.com/2008/fbml"  xml:lang="nl"  lang="nl">
<head>
<title>Ungah Browser</title>

<script type="text/javascript" src="{$scriptUrl}jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="{$scriptUrl}jquery-ui-1.8.16.custom.min.js"></script>
<!-- <script type="text/javascript" src="{$scriptUrl}jquery.wowwindow.js"></script> -->
<script type="text/javascript" src="{$scriptUrl}tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="{$scriptUrl}adminFunctions.js"></script>
<script type="text/javascript" src="{$scriptUrl}custom-form-elements.js"></script>

<link rel="stylesheet" type="text/css" href="{$styleUrl}admin/wowwindow.css"> 
<link rel="stylesheet" type="text/css" href="{$styleUrl}admin/style.css">

<script type="text/javascript" src="{$scriptUrl}tiny_mce/tiny_mce_popup.js"></script>

<script language="javascript" type="text/javascript">
var FileBrowserDialogue = {
    init : function () {
        // Here goes your code for setting your custom things onLoad.
    },
    useFile : function (fileUrl) {
        //var URL = document.my_form.my_field.value;
		var URL = fileUrl;
        var win = tinyMCEPopup.getWindowArg("window");

        // insert information now
        win.document.getElementById(tinyMCEPopup.getWindowArg("input")).value = URL;

        // are we an image browser
        if (typeof(win.ImageDialog) != "undefined")
        {
            // we are, so update image dimensions and preview if necessary
            if (win.ImageDialog.getImageData) win.ImageDialog.getImageData();
            if (win.ImageDialog.showPreviewImage) win.ImageDialog.showPreviewImage(URL);
        }

        // close popup window
        tinyMCEPopup.close();
    }
}

tinyMCEPopup.onInit.add(FileBrowserDialogue.init, FileBrowserDialogue);

</script>


</head>
<body>

{include file='admin/pages/filemanager.tpl'}

</body>
</html>
