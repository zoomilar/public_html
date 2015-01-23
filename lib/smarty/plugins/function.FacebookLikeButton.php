<?php

////////////////////////////////////////////////////////////////////////////////
//
// File:	function.FacebookLikeButton.php
// Project:	Facebook Bookmarking plugin for CMS Made Simple
// Version:	1.0
// Licence:	Free software under the GNU General Public License
// Web:		http://dev.cmsmadesimple.org/projects/fblikebutton
// Created:	20121113, v1.0, Magal Hezi
//
////////////////////////////////////////////////////////////////////////////////

function smarty_function_FacebookLikeButton($params, &$smarty) {

	$gCms = cmsms();

	$data_send= isset($params['send']) ? ' data-send="'.$params['send']. '"' : ' data-send="true"';
	$data_width= isset($params['width']) ? ' data-width="'.$params['width']. '"' : ' data-width="450"';
	$show_faces= isset($params['show_faces']) ? ' data-show-faces="'.$params['show_faces']. '"' : ' data-show-faces="true"';
	$class = isset($params['class']) ? trim($params['class']) : '';	
	$custom_url = isset($params['custom_url']) ? trim($params['custom_url']) : ""; 
	$data_action = isset($params['action']) ? ' data-action="' . trim($params['action']) . '"' : "";
	$data_colorscheme = isset($params['colorscheme']) ? ' data-colorscheme="' . trim($params['colorscheme']) . '"' : "";
	$data_font = isset($params['font']) ? ' data-font="' . trim($params['font']) . '"' : "";
	$data_layout = isset($params['layout']) ? ' layout="' . trim($params['layout']) . '"' : "";
	$lang = isset($params['lang']) ? trim($params['lang']) : "en_US";

	if ($custom_url != "") {
		// manually set
		$url = $custom_url;
	} else {
		// self detection
		if($real_url){
			$isHTTPS = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on");
			$port = (isset($_SERVER["SERVER_PORT"]) && ((!$isHTTPS && $_SERVER["SERVER_PORT"] != "80") || ($isHTTPS && $_SERVER["SERVER_PORT"] != "443")));
			$port = ($port) ? ':' . $_SERVER["SERVER_PORT"] : '';
			$url = ($isHTTPS ? 'https://' : 'http://') . $_SERVER["SERVER_NAME"] . $port . $_SERVER["REQUEST_URI"];
		} else {
			$hm =& $gCms->GetHierarchyManager();
			$page_content_id = $gCms->variables['content_id'];
			$curnode =& $hm->getNodeById($page_content_id);
			$curcontent =& $curnode->GetContent();
			$url = $curcontent->GetURL();
		}
	}	

	$result = "";
	$result .= '<!-- Start Facebook plugin -->' . PHP_EOL;
	$result .= '<div id="fb-root"></div>';
	$result .= '<script>(function(d, s, id) {';
	$result .= 'var js, fjs = d.getElementsByTagName(s)[0];';
	$result .= 'if (d.getElementById(id)) return;';
	$result .= 'js = d.createElement(s); js.id = id;';
	$result .= 'js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1";';
	$result .= 'fjs.parentNode.insertBefore(js, fjs);';
	$result .= "}(document, 'script', 'facebook-jssdk'));</script>";
	$result .= '<div class="fb-like '.$class.'" data-href="' . $url . '"'.$data_send . $data_width . $show_faces. $data_action . $data_colorscheme . $data_font . $data_layout .'></div>';
	$result .= '<!-- End Facebook plugin -->';

	return $result;

}

function smarty_help_function_FacebookLikeButton() {
	?>
	<h3>What does this do?</h3>
	<p>The Like button lets a user share your content with friends on Facebook. When the user clicks the Like button on your site, a story appears in the user's friends' News Feed with a link back to your website.</p>
<h3>How do I use it?</h3>
	<p>Insert the tag <code>{FacebookLikeButton}</code> into your template or page (case sensitive).</p>
	<p>To ensure that web-designers have maximum control over customization, if you want to style the plugin's output, feel free to use additional external CSS rules in conjunction with the <code>class</code> parameter.</p>
<p>Alternatively, you can always use the <code>custom_url</code> parameters to set manually (or pass them via smarty) the url and title values of the current page without self detection functionality.</p>
	<h3>What parameters does it take?	</h3>
	<ul>
<li><em>(optional)</em> <code>layout</code></li>
		<ul>
			<li>there are three options. 
			  <ul>
			    <li>standard
			      <ul>
			        <li>displays social text to the right of the button and friends' profile photos below. Minimum width: 225 pixels. Minimum increases by 40px if action is 'recommend' by and increases by 60px if send is 'true'. Default width: 450 pixels. Height: 35 pixels (without photos) or 80 pixels (with photos). </li>
			        <li><code>{FacebookLikeButton layout="standard"}</code></li>
		          </ul>
			    </li>
			    <li>button_count
			      <ul>
			        <li>displays the total number of likes to the right of the button. Minimum width: 90 pixels. Default width: 90 pixels. Height: 20 pixels.</li>
			        <li><code>{FacebookLikeButton layout="button_count"}</code></li>
		          </ul>
			    </li>
			    <li>box_count
			      <ul>
			        <li>displays the total number of likes above the button. Minimum width: 55 pixels. Default width: 55 pixels. Height: 65 pixels.</li>
			        <li><code>{FacebookLikeButton layout="box_count"}</code></li>
		          </ul>
			    </li>
		      </ul>
		  </li>
		</ul>
	  <li><em>(optional)</em> <code>send</code></li>
		<ul>
			<li>specifies whether to include a Send button with the Like button.</li>
			<li>E.g. <code>{FacebookLikeButton send="false"}</code></li>
		</ul>
		<li><em>(optional)</em> <code>class</code></li>
        <ul>
          <li>Populates the "<code>class</code>" attribute of the link, set the CSS class name</li>
          <li>E.g. <code>{FacebookLikeButton class="MyCssClassName"}</code></li>
        </ul>
      <li><em>(optional)</em> <code>show_faces</code></li>
		<ul>
			<li>specifies whether to display profile photos below the button (standard layout only)</li>
			<li>E.g.<code>{FacebookLikeButton show_faces="false"}</code></li>
		</ul>
		<li><em>(optional)</em> <code>width</code></li>
		<ul>
			<li>the width of the Like button.</li>
			<li>E.g. <code>{FacebookLikeButton width="200"}</code></li>
		</ul>
<li><em>(optional)</em> <code>action</code></li>
		<ul>
			<li>the verb to display on the button.
			  <ul>
			    <li>like</li>
			    <li>recommend</li>
		      </ul>
		    </li>
			<li>E.g. <code>{FacebookLikeButton action="recommend"}</code></li>
		</ul>
		<li><em>(optional)</em> <code>font</code></li>
		<ul>
			<li>the font to display in the button.
			  <ul>
			    <li>arial</li>
			    <li>lucida grande</li>
			    <li>segoe ui</li>
			    <li>tahoma</li>
			    <li>trebuchet ms</li>
			    <li>verdana </li>
		      </ul>
			</li>
			<li>E.g. <code>{FacebookLikeButton font="tahoma"}</code></li>
		</ul>
		<li><em>(optional)</em> <code>colorscheme</code></li>
		<ul>
			<li>the color scheme for the like button.
			  <ul>
			    <li>light</li>
			    <li>dark </li>
		      </ul>
		    </li>
			<li>E.g. <code>{FacebookLikeButton colorscheme="<strong>dark</strong><strong></strong>"}</code></li>
		</ul>
<li><em>(optional)</em> <code>custom_url</code></li>
		<ul>
			<li>Set manually the <strong>complete</strong> url of the current page without self detection functionality</li>
			<li>Simply specify the URL of your Facebook page in the href parameter of the button.</li>
			<li>E.g. <code>{FacebookLikeButton custom_url="http://www.domain.ext/my/current/page"}</code></li>
		</ul>
		<li><em>(optional)</em> <code>lang</code></li>
        <ul>
          <li>Facebook is currently available in over 70 languages.</li>
          <li>The locales that Facebook supports are available in an <a href="http://www.facebook.com/translations/FacebookLocales.xml" target="_blank">XML file</a>.</li>
          <li>Default language is 'en_US' and represents US English.</li>
          <li>E.g. <code>{FacebookLikeButton lang="es_LA"}</code></li>
        </ul>
        <p>&nbsp;</p>
</ul>
	<?php
}

function smarty_about_function_FacebookLikeButton() {
	?>
<p>Author: Magal Hezi</p>
<p>Version: 1.0</p>
	<p>Update: Check for updates for this plugin at the <a href="http://dev.cmsmadesimple.org/projects/likebutton" target="_blank">CMS Made Simple Forge page</a></p>
	<p>Feature Requests: If you want to add others social bookmarking services or functionality, please let me know by opening a new feature request in the dedicated <strong>Feature Requests tab</strong> of the <a href="http://dev.cmsmadesimple.org/projects/likebutton" target="_blank">CMS Made Simple Forge page</a> for this plugin</p>
	<p>Bugs: If you want to submit a new bug, please let me know by opening a new bug in the dedicated <strong>Bug Tracker tab</strong> of the <a href="http://dev.cmsmadesimple.org/projects/likebutton" target="_blank">CMS Made Simple Forge page</a> for this plugin</p>
	<p>Licence: Free software under the GNU General Public License</p>
	<p>Change History:</p>
	<ul>
<li>Version 1.0</li>
		<ul>
			<li>First release</li>
		</ul>
	</ul>
	<?php
}
?>
