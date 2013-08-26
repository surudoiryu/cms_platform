$(document).ready(function() {

	$('[name^="moveRow_"]').live('mouseenter', function(){
			var id = $(this).attr("name").substr(8);
			$(this).css('backgroundColor','#85C6ED');
			$('#child_'+id).fadeIn(0);
	});
	
	$('[name^="moveRow_"]').live('mouseleave', function(){
			var id = $(this).attr("name").substr(8);
			$('#child_'+id).fadeOut(0);
	});
	
	$('[name^="staticRow_"]').live('mouseenter', function(){
			var id = $(this).attr("name").substr(10);
			$('#child_'+id).fadeIn(0);
	});
	
	$('[name^="staticRow_"]').live('mouseleave', function(){
			var id = $(this).attr("name").substr(10);
			$('#child_'+id).fadeOut(0);
	});
	
	$('[name^="deletePage_"]').live('click', function(){
		var answer	=	confirm("Delete?");
		if(answer)
		{
			var id = $(this).attr("name").substr(11);
			$.ajax({
				type: 'POST',
				url: "" + getBaseURL() + "admin/ajax/deletePages/",
				data: { deletePage: "" + id },
				success: function(responseData){
					//alert(responseData);
				}
			});
			
			$('[name="moveRow_'+id+'"]').fadeOut('fast');
		}else{
			//Niets aan de hand er gebeurd niets.
		}
	});
	
	$('[name^="deleteUser_"]').live('click', function(){
		var answer	=	confirm("Delete?");
		if(answer)
		{
			var id = $(this).attr("name").substr(11);
			$.ajax({
				type: 'POST',
				url: "" + getBaseURL() + "admin/ajax/deleteUsers/",
				data: { deleteUser: "" + id },
				success: function(responseData){
					//alert(responseData);
				}
			});
			
			$('[name="moveRow_'+id+'"]').fadeOut('fast');
		}else{
			//Niets aan de hand er gebeurd niets.
		}
	});
	
	$('[name^="deleteFile_"]').live('click', function(){
		var answer	=	confirm("Delete?");
		if(answer)
		{
			var file	= $(this).attr("name").substr(11);
			var id 		= file.replace(".", "_");

			$.ajax({
				type: 'POST',
				url: "" + getBaseURL() + "admin/ajax/deleteFile/",
				data: { deleteFile: "" + file },
				success: function(responseData){
					alert(responseData);
				}
			});
			
			$('[name="moveRow_'+id+'"]').fadeOut('fast');
		}else{
			//Niets aan de hand er gebeurd niets.
		}
	});
	
	$('[name^="editFile_"]').live('click', function(){
		var file	= $(this).attr("name").substr(9);
		var rename	= file.split(".");
		var extent	= rename[rename.length-1];
		var id 		= file.replace(".", "_");
		var answer	=	prompt("Voer nieuwe naam in.", file.substr(0, (file.length - (extent.length+1))) );
		if(answer.length > 0)
		{
			$.ajax({
				type: 'POST',
				url: "" + getBaseURL() + "admin/ajax/editFile/",
				data: { renameFile: answer + "." + extent, editFile: "" + file},
				success: function(responseData){
					//alert(responseData);
					$('[name="fileSpan_'+file+'"]').html(answer);
				}
			});
			
		}else{
			//Niets aan de hand er gebeurd niets.
		}
	});

});

function getBaseURL() {
	var url = location.href;  // entire url including querystring - also: window.location.href;
	var baseURL = url.substring(0, url.indexOf('/', 14));
	if (baseURL.indexOf('http://localhost') != -1) {
		// Base Url for localhost
		var url = location.href;  // window.location.href;
		var pathname = location.pathname;  // window.location.pathname;
		var index1 = url.indexOf(pathname);
		var index2 = url.indexOf("/", index1 + 1);
		var baseLocalUrl = url.substr(0, index2);
		return baseLocalUrl + "/";
	}else {
		return baseURL + "/";
	}
}

function fileManager_Upload(sessionId){
	var swfu;
	var settings = {
		flash_url : getBaseURL() + "public/scripts/swfupload/swfupload.swf",
		upload_url: getBaseURL() + "admin/ajax/swfupload/",
		post_params: {"PHPSESSID" : sessionId},
		file_size_limit : "100 MB",
		file_types : "*.*",
		file_types_description : "Alle Bestanden",
		file_upload_limit : 100,
		file_queue_limit : 0,
		custom_settings : {
			progressTarget : "fsUploadProgress",
			cancelButtonId : "btnCancel"
		},
		debug: false,
		prevent_swf_caching: true,

		// Button settings
		button_image_url: getBaseURL() + "public/images/admin/TestImageNoText_65x29.png",
		button_width: "100",
		button_height: "29",
		button_placeholder_id: "spanButtonPlaceHolder",
		button_text: '<span class="theFont">Bladeren...</span>',
		button_text_style: ".theFont { font-size: 16; }",
		button_text_left_padding: 12,
		button_text_top_padding: 3,
		
		// The event handler functions are defined in handlers.js
		file_queued_handler : fileQueued,
		file_queue_error_handler : fileQueueError,
		file_dialog_complete_handler : fileDialogComplete,
		upload_start_handler : uploadStart,
		upload_progress_handler : uploadProgress,
		upload_error_handler : uploadError,
		upload_success_handler : uploadSuccess,
		upload_complete_handler : uploadComplete,
		queue_complete_handler : queueComplete	// Queue plugin event
	};

	swfu = new SWFUpload(settings);
}