<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  xmlns:og="http://ogp.me/ns#"  xmlns:fb="https://www.facebook.com/2008/fbml"  xml:lang="nl"  lang="nl">
<head>
	<title>SES Platform</title>
	<script type="text/javascript" src="{$scriptUrl}custom-form-elements.js"></script>
	<link rel="stylesheet" type="text/css" href="{$styleUrl}admin/style.css">
</head>
<body style='margin:0px; padding:0px; background: #69ceff url({$imagesUrl}admin/bgLogin.jpg) repeat-x top left;'>
	<div class='loginUngah' style='background: url({$imagesUrl}admin/ungahLogin.png) no-repeat top left;'>&nbsp;</div>
	<div class='loginMazing' style='background: url({$imagesUrl}admin/mazingLogin.png) no-repeat bottom right;'>&nbsp;</div>
	<div class='loginCentered' style='font-size:12px; font-family:arial;'>
		<div style="position:absolute; top:-56px; background: url({$imagesUrl}admin/logo.png) no-repeat top left; height:68px; width:218px;">&nbsp;</div>
		<form method='post'>
			<div id='loginWrapper'>
				<div id='login_top'><span style='position:relative; top:15px; left:15px;'>Inloggen</span></div>
				<div id='login_middle'>
					{if isset($message)}
						<div style='width:100%; height:20px;'>
							<div style='color: #FF0000; font-weight: bold;'>* {$message}</div>
						</div>
					{/if}
					<div class='newRow'>
						<div class='fieldLeft'>inlog naam:</div>
						<div class='fieldRight'><input style='width:85%' type='text' id='username' name='username' value='{$this->input->cookie('username', TRUE)}'></div>
					</div>
					
					<div class='newRow'>
						<div class='fieldLeft'>wachtwoord</div>
						<div class='fieldRight'><input style='width:85%' type='password' id='password' name='password' value='{$this->input->cookie('password', TRUE)}'></div>
					</div>
					
					<div class='newRow'>
						<div class='fieldLeft' style='margin-top:-5px;'><input type="checkbox" id='keep_username' name='keep_username' class="styled" {if $this->input->cookie('username', TRUE) != ""} checked='checked' {/if} /> <span style='position:relative; top:4px;'>inlog onthouden</span></div>
						<div class='fieldRight'><input type="checkbox" id='keep_password' name='keep_password' class="styled" {if $this->input->cookie('password', TRUE) != ""} checked='checked' {/if} /> <span style='position:relative; top:4px;'>wachtwoord onthouden</span></div>
					</div>
				</div>
				<div id='login_bottom'>
					<div style='width:100%; height:35px;'>
						<div style='padding-left:6px; padding-top:15px;'><input type='button' class='loginBtn' value='terug' onclick='window.location="{$base_url_fe}";'><input type='submit' style='margin-left:15px;' class='loginBtn' value='inloggen' name='submit_user' id='submit_user'></div>
					</div>
				</div>
			</div>
		</form>
		<div style="position:absolute; bottom:-20px;"><span style='font-style:italic; color:#505050;'>ontwikkeld door <a href='http://www.ungahstudios.com/' target='_blank'>UngahStudio&#39;s</a> &amp; <a href='http://www.ungahstudios.com/' target='_blank'>M-azing media</a></span></div>
	</div>
</body>
</html>