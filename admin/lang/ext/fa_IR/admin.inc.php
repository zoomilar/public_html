<?php
$lang['admin']['help_function_cms_init_editor'] = '<h3>What does this do?</h3>
  <p>This plugin is used to initialize the selected wysiwyg editor for display when wysiwyg functionalities are required for frontend data submission.  This module will find the selected frontend wysiwyg, determine if it has been requested, and if so generate the appropriate html code <em>(usually javascript links)</em> so that the wysiwyg will initialize properly when the page is loaded.  If no wysiwyg editors have been requested for the frontend request this plugin will produce no output.</p>
  <p><strong>Note:</strong> This plugin will work properly given the default configuration of CMSMS.  If you have modified the &quot;process_whole_template&quot; configuration variable from its default value, you may have to adjust the parameters supplied to this plugin.</p>
<h3>How do I use it?</h3>
<p>The first thing you must do is select the frontend WYSIWYG editor to use in the global settings page of the admin console.  Next If you use frontend wysiwyg editors on numerous pages, it may be best to place the {cms_init_editor} plugin directly into your page template.  If you only require the wysiwyg editor to be enabled on a limited amount of pages you may just place it into the &quot;Page Specific Metadata&quot; field in each page.</p>
<h3>What parameters does it take?</h3>
<ul>
<li><em>(optional)wysiwyg</em> - Specify the name of the wysiwyg editor module to initialize.  Use with caution.  If you have a different wysiwyg editor selected in the global settings, this will force the specified  editor to be initialized.</li>
<li><em>(optional)force=0</em> - Normally this plugin will not initialize the specified (or detected) editor if it has not been marked as &quot;active&quot;.  This parameter will override that behavior.  This parameter may be required of the &quot;process_whole_template&quot; configuration variable is set to a non default value.</li>
<li><em>(optional)assign</em> - Assign the output of the plugin to the named smarty variable.</li>
</ul>';
$lang['admin']['info_pagedefaults'] = 'This form allows specifying various options as to the initial settings when creating new content pages.  The items in this page have no effect when editing existing pages';
$lang['admin']['default_contenttype'] = 'Default Content Type';
$lang['admin']['info_default_contenttype'] = 'Applicable when adding new content objects, this control specifies the type that is selected by default.  Please ensure that the selected item is not one of the &quot;disallowed types&quot;.';
$lang['admin']['error_contenttype'] = 'The content type associated with this page is invalid or not permitted';
$lang['admin']['info_disallowed_contenttypes'] = 'Select which content types to remove from the content type dropdown when editing or adding content.  Use CTRL+Click to select, unselect items.  Having no selected items will indicate that all content types are allowed. <em>(applies to all users)</em>';
$lang['admin']['disallowed_contenttypes'] = 'Content Types that are not Allowed';
$lang['admin']['search_module'] = 'ماژول جستجو';
$lang['admin']['info_search_module'] = 'Select the module that should be used to index words for searching, and will provide the site search capabilities';
$lang['admin']['filecreatedirbadchars'] = 'Invalid characters were detected in the submitted directory name';
$lang['admin']['modulehelp_yourlang'] = 'نمایش در زبان شما';
$lang['admin']['info_umask'] = 'The &quot;umask&quot; is an octal value that is used to specify the default permission for newly created files (this is used for files in the cache directory, and uploaded files.  For more information see the appropriate <a href="http://en.wikipedia.org/wiki/Umask">wikipedia article.</a>';
$lang['admin']['general_operation_settings'] = 'تنظیمات عمومی';
$lang['admin']['info_checkversion'] = 'If enabled, the system will perform a daily check for a new release of CMSMS';
$lang['admin']['checkversion'] = 'Allow periodic checks for new versions';
$lang['admin']['actioncontains'] = 'Action Contains';
$lang['admin']['filterapplied'] = 'Current Filter';
$lang['admin']['automatedtask_success'] = 'Automated task performed';
$lang['admin']['siteprefsupdated'] = 'Global Settings Updated';
$lang['admin']['ip_addr'] = 'آدرس IP';
$lang['admin']['warn_admin_ipandcookies'] = 'Warning: Admin activities use cookies and tracks your IP address';
$lang['admin']['event_desc_loginfailed'] = 'ورود به درستی انجام نشد';
$lang['admin']['modulehelp_english'] = 'نمایش در زبان انگلیسی';
$lang['admin']['nopluginabout'] = 'درباره این پلاگین مطلبی برای نمایش نیست';
$lang['admin']['nopluginhelp'] = 'راهنمایی برای این پلاگین موجود نیست';
$lang['admin']['moduleupgraded'] = 'موفقیت در ارتقاء';
$lang['admin']['added_css'] = 'Added Stylesheet';
$lang['admin']['toggle'] = 'Toggle';
$lang['admin']['added_group'] = 'گروه اضافه شد';
$lang['admin']['expanded_xml'] = 'Expanded XML file consisting of %s %s';
$lang['admin']['installed_mod'] = 'نسخه %s نصب شده است';
$lang['admin']['uninstalled_mod'] = 'ماژول %s حذف شد';
$lang['admin']['upgraded_mod'] = '%s از نسخه %s به نسخه %s ارتقا یافت';
$lang['admin']['edited_gcb'] = 'Edited Global Content Block';
$lang['admin']['edited_content'] = 'محتوا ویرایش شد';
$lang['admin']['added_content'] = 'محتوا اضافه شد';
$lang['admin']['added_css_association'] = 'Added Stylesheet Association';
$lang['admin']['deleted_group'] = 'حذف گروه انجام شد';
$lang['admin']['deleted_content'] = 'محتوا حذف شد';
$lang['admin']['edited_user'] = 'شناسه ویرایش شد';
$lang['admin']['edited_udt'] = 'Edited User Defined Tag';
$lang['admin']['content_copied'] = 'Content Item Copied to %s';
$lang['admin']['deleted_template'] = 'قالب حذف شد';
$lang['admin']['added_udt'] = 'Added User Defined Tag';
$lang['admin']['deleted_udt'] = 'Deleted User Defined Tag';
$lang['admin']['added_gcb'] = 'Added Global Content Block';
$lang['admin']['edited_group'] = 'گروه ویرایش شد';
$lang['admin']['deleted_css_association'] = 'Deleted Stylesheet Association';
$lang['admin']['user_logout'] = 'خروج کاربر';
$lang['admin']['user_login'] = 'ورود کاربر';
$lang['admin']['login_failed'] = 'ورود کاربر انجام نشد';
$lang['admin']['deleted_css'] = 'Deleted Stylesheet';
$lang['admin']['uploaded_file'] = 'فایل بارگذاری شد';
$lang['admin']['created_directory'] = 'پوشه ایجاد شد';
$lang['admin']['deleted_file'] = 'فایل حذف شد';
$lang['admin']['deleted_directory'] = 'پوشه حذف شد';
$lang['admin']['edited_template'] = 'قالب ویرایش شد';
$lang['admin']['deleted_user'] = 'کاربر حذف شد';
$lang['admin']['deleted_module'] = 'Permanently removed %s';
$lang['admin']['deleted_gcb'] = 'Deleted Global Content Block';
$lang['admin']['added_user'] = 'کاربر اضافه شد';
$lang['admin']['edited_user_preferences'] = 'Edited User Preferences';
$lang['admin']['added_template'] = 'قالب اضافه شد';
$lang['admin']['event_desc_stylesheetpostcompile'] = 'Sent after a stylesheet is compiled through smarty';
$lang['admin']['event_desc_stylesheetprecompile'] = 'Sent before a stylesheet is compiled through smarty';
$lang['admin']['confirm_uploadmodule'] = 'Are you sure you would like to upload the selected XML file. Incorrectly uploading a module file may break a functioning website';
$lang['admin']['error_module_mincmsversion'] = 'This module requires a newer version of CMS Made Simple';
$lang['admin']['info_browser_cache_expiry'] = 'Specify the amount of time (in minutes) that browsers should cache pages for.  Setting this value to 0 disables the functionality';
$lang['admin']['browser_cache_expiry'] = 'Browser Cache Expiry Period <em>(minutes)</em>';
$lang['admin']['info_browser_cache'] = 'Applicable only to cachable pages, this setting indicates that browsers should be allowed to cache the pages for an amount of time.  If enabled repeat visitors to your site may not immediately see changes to the content of the pages.';
$lang['admin']['allow_browser_cache'] = 'Allow Browser to Cache Pages';
$lang['admin']['server_cache_settings'] = 'تنظیم&zwnj;های ذخیره&zwnj;ساز میزبان';
$lang['admin']['browser_cache_settings'] = 'تنظیم&zwnj;های ذخیره&zwnj;ساز مرورگر';
$lang['admin']['help_function_browser_lang'] = '<h3>What does this do?</h3>
  <p>This plugin detects and outputs the language that the users browser accepts, and cross references it with a list of allowed languages to determine a language value for the session.</p>
<h3>How do I use it?</h3>
<p>Insert the tag early into your page template <em>(it can go above the <head> section if you want)</em> and provide it the name of the default language, and the accepted languages (only two character language names are accepted), then do something with the result.  i.e:</p>
<pre><code>{browser_lang accept=de,fr,en,es default=en assign=tmp}{session_put var=lang val=$tmp}</code></pre>
<p><em>({session_put} is a plugin provided by the CGSimpleSmarty module)</em></p>
<h3>What Parameters does it Take?</h3>
<ul>
<li><strong>accepted <em>(required)</em></strong><br/> - A comma separated list of two character language names that are accepted.</li>
<li>default<br/>- <em>(optional)</em> A default language to output if no accepted language was supported by the browser.  en is used if no other value is specified.</li>
<li>assign<br/>- <em>(optional)</em> The name of the smarty variable to assign the results to.  If not specified the results of this function are returned.</li>
</ul>';
$lang['admin']['info_target'] = 'This option may used by the Menu Manager to indicate when and how new frames or windows should be opened.  Some menu manager templates may ignore this option.';
$lang['admin']['close'] = 'بستن';
$lang['admin']['revert'] = 'Revert all changes';
$lang['admin']['autoclearcache2'] = 'Remove cache files that are older than the specified number of days';
$lang['admin']['root'] = 'ریشه';
$lang['admin']['info_content_autocreate_flaturls'] = 'This will set all URLs to the same value as the Page Alias. Note: The two values will not be synchronised after first being set';
$lang['admin']['content_autocreate_flaturls'] = 'Automatically created URL&#039;s are flat';
$lang['admin']['content_autocreate_urls'] = 'Automatically create page URL&#039;s';
$lang['admin']['content_mandatory_urls'] = 'Page URLS are required';
$lang['admin']['content_imagefield_path'] = 'Path for image field';
$lang['admin']['info_content_imagefield_path'] = 'Relative to the image uploads path, specify a directory name that contains the paths containing files for the image field';
$lang['admin']['content_thumbnailfield_path'] = 'Path for thumbnail field';
$lang['admin']['info_content_thumbnailfield_path'] = 'Relative to the image uploads path, specify a directory name that contains the paths containing files for the image field.  Usually this will be the same as the path above.';
$lang['admin']['contentimage_path'] = 'Path for {content_image} tag';
$lang['admin']['info_contentimage_path'] = 'Relative to the uploads path, specify a directory name that contains the paths containing files for the {content_image} tag.  This value is used as a default for the dir parameter';
$lang['admin']['editcontent_settings'] = 'در حال ویرایش تنظیم&zwnj;های محتوا';
$lang['admin']['help_page_url'] = 'Specify an alternate URL (relative to the root of your website) that can be used to uniquely identify this page.  i.e: path/to/mypage.  The page url is only useful when pretty urls are enabled.';
$lang['admin']['help_page_alias'] = 'The alias is used as an alternate to the page id to uniquely identify a page. It must be unique across all pages.  The alias is also used to assist in building the URL for the page';
$lang['admin']['help_page_searchable'] = 'This setting indicates whether the content of this page should be indexed by the Search module';
$lang['admin']['help_page_cachable'] = 'Performance can be increased by setting as many pages as possible to cachable.  However this cannot be used for pages where content may change on a per request basis';
$lang['admin']['sitedownexcludeadmins'] = 'Exclude users logged in to the CMSMS admin console';
$lang['admin']['your_ipaddress'] = 'آدرس IP شما :';
$lang['admin']['use_wysiwyg'] = 'Use WYSIWYG';
$lang['admin']['contenttype_redirlink'] = 'Redirecting Link';
$lang['admin']['yes'] = 'بله';
$lang['admin']['no'] = 'خیر';
$lang['admin']['listcontent_showalias'] = 'Display the &quot;Alias&quot; column';
$lang['admin']['listcontent_showurl'] = 'Display the &quot;URL&quot; column';
$lang['admin']['listcontent_showtitle'] = 'Display the Page Title or Menu Text';
$lang['admin']['listcontent_settings'] = 'Content List Settings';
$lang['admin']['lctitle_page'] = 'The title of existing content items';
$lang['admin']['lctitle_alias'] = 'The alias of existing content items. Some content items do not have aliases';
$lang['admin']['lctitle_url'] = 'The URL suffix for the content item.  If set';
$lang['admin']['lctitle_template'] = 'The selected template for the content item. Some content items do not have templates';
$lang['admin']['lctitle_owner'] = 'The owner of the content item';
$lang['admin']['lctitle_active'] = 'Indicates whether the content item is active. Inactive items cannot be displayed.';
$lang['admin']['lctitle_default'] = 'Specify the content item that is accessed when the root url is requested.  Only one item can be default';
$lang['admin']['lctitle_move'] = 'Allows arranging your content hierarchy';
$lang['admin']['lctitle_multiselect'] = 'Select all visible items / Select none';
$lang['admin']['invalid_url'] = 'The page URL specified is invalid.  It should contain only alphanumeric characters, or - or /.  It is also possible that the URL specified is already in use.';
$lang['admin']['page_url'] = 'آدرس اینترنتی صفحه';
$lang['admin']['runuserplugin'] = 'Run User Plugin';
$lang['admin']['output'] = 'Output';
$lang['admin']['run'] = 'Run';
$lang['admin']['run_udt'] = 'Run this User Defined Tag';
$lang['admin']['stylesheetcopied'] = 'Stylesheet Copied';
$lang['admin']['templatecopied'] = 'رونوشتی از قالب تهیه شد';
$lang['admin']['ecommerce_desc'] = 'Modules for providing E-commerce capabilities';
$lang['admin']['ecommerce'] = 'E-Commerce';
$lang['admin']['help_function_content_module'] = '<h3>What does this do?</h3>
<p>This content block type allows interfacing with different modules to create different content block types.</p>
<p>Some modules can define content block types for use in module templates.  i.e: The FrontEndUsers module may define a group list content block type.  It will then indicate how you can use the content_module tag to utilize that block type within your templates.</p>
<p><strong>Note:</strong> This block type must be used only with compatible modules.  You should not use this in any way except for as guided by addon modules.</p>';
$lang['admin']['error_parsing_content_blocks'] = 'An error occurred parsing content blocks (perhaps duplicated block names)';
$lang['admin']['error_no_default_content_block'] = 'No default content block was detected in this template.  Please ensure that you have a {content} tag in the page template.';
$lang['admin']['help_function_cms_stylesheet'] = '	<h3>What does this do?</h3>
  <p>A replacement for the {stylesheet} tag, this tag provides caching of css files by generating static files in the tmp/cache directory, and smarty processing of the individual stylesheets.</p>
  <p>This plugin retrieves stylesheet information from the system.  By default, it grabs all of the stylesheets attached to the current template in the order specified by the designer, and generates stylesheet tags.</p>
  <p>Generated stylesheets are uniquely named according to the last modification date in the database, and are only generated if the stylesheet has changed.</p>
  <p>This tag is the replacement for the {stylesheet} tag.</p>
  <h3>How do I use it?</h3>
  <p>Just insert the tag into your template/page&#039;s head section like: <code>{cms_stylesheet}</code></p>
  <h3>What parameters does it take?</h3>
  <ul>
  <li><em>(optional)</em>name - Instead of getting all stylesheets for the given page, it will only get one specifically named one, whether it&#039;s attached to the current template or not.</li>
  <li><em>(optional)</em>templateid - If templateid is defined, this will return stylesheets associated with that template instead of the current one.</li>
  <li><em>(optional)</em>media - When used in conjunction with the name parameter this parameter will allow you to override the media type for that stylesheet.  When used in conjunction with the templateid parameter, the media parameter will only output stylesheet tags for those stylesheets that are marked as compatible with the specified media type.</li>
  </ul>
  <h3>Smarty Processing</h3>
  <p>When generating css files this system passes the stylesheets retrieved from the database through smarty.  The smarty delimiters have been changed from the CMSMS standard { and } to [[ and ]] respectively to ease transition in stylesheets.  This allows creating smarty variables i.e.: [[assign var=&#039;red&#039; value=&#039;#900&#039;]] at the top of the stylesheet, and then using these variables later in the stylesheet, i.e:</p>
<pre>
<code>
h3 .error { color: [[$red]]; }<br/>
</code>
</pre>
<p>Because the cached files are generated in the tmp/cache directory of the CMSMS installation, the CSS relative working directory is not the root of the website.  Therefore any images, or other tags that require a url should use the [[root_url]] tag to force it to be an absolute url. i.e:</p>
<pre>
<code>
h3 .error { background: url([[root_url]]/uploads/images/error_background.gif); }<br/>
</code>
</pre>
<p><strong>Note:</strong> Due to the caching nature of the plugin, smarty variables should be placed at the top of EACH stylesheet that is attached to a template.</p>';
$lang['admin']['pseudocron_granularity'] = 'Pseudocron Granularity';
$lang['admin']['info_pseudocron_granularity'] = 'This setting indicates how often the system will attempt to handle regularly scheduled tasks';
$lang['admin']['cron_request'] = 'Each Request';
$lang['admin']['cron_15m'] = '15 دقیقه';
$lang['admin']['cron_30m'] = '30 دقیقه';
$lang['admin']['cron_60m'] = '1 ساعت';
$lang['admin']['cron_120m'] = '2 ساعت';
$lang['admin']['cron_3h'] = '3 ساعت';
$lang['admin']['cron_6h'] = '6 ساعت';
$lang['admin']['cron_12h'] = '12 ساعت';
$lang['admin']['cron_24h'] = '24 ساعت';
$lang['admin']['adminlog_1day'] = '1 روز';
$lang['admin']['adminlog_1week'] = '1 هفته';
$lang['admin']['adminlog_2weeks'] = '2 هفته';
$lang['admin']['adminlog_1month'] = '1 ماه';
$lang['admin']['adminlog_3months'] = '3 ماه';
$lang['admin']['adminlog_6months'] = '6 ماه';
$lang['admin']['adminlog_manual'] = 'Manual deletion';
$lang['admin']['adminlog_lifetime'] = 'Lifetime of log-entries';
$lang['admin']['info_adminlog_lifetime'] = 'Remove log-entries that are older than the specified period.';
$lang['admin']['filteruser'] = 'شناسه کاربری هست ';
$lang['admin']['filtername'] = 'Event name contains';
$lang['admin']['filteraction'] = 'Action contains';
$lang['admin']['filterapply'] = 'Apply filters';
$lang['admin']['filterreset'] = 'Reset filters';
$lang['admin']['filters'] = 'Filters';
$lang['admin']['showfilters'] = 'Edit filter';
$lang['admin']['clearcache_taskdescription'] = 'Executed daily, this task will clear cached files that are older than the age preset in the global preferences';
$lang['admin']['clearcache_taskname'] = 'حذف فایل&zwnj;های ذخیره&zwnj;سازی شده';
$lang['admin']['info_autoclearcache'] = 'Specify an integer value. Enter 0 to disable automatic cache clearing';
$lang['admin']['autoclearcache'] = 'Automatically clear the cache every N days';
$lang['admin']['listtemplates_pagelimit'] = 'Number of rows per page when viewing templates';
$lang['admin']['liststylesheets_pagelimit'] = 'Number of rows per page when viewing stylesheets';
$lang['admin']['listgcbs_pagelimit'] = 'Number of rows per page when viewing Global Content Blocks';
$lang['admin']['insecure'] = 'Insecure (HTTP)';
$lang['admin']['secure'] = 'Secure (HTTPS)';
$lang['admin']['secure_page'] = 'Use HTTPS for this page';
$lang['admin']['thumbnail_width'] = 'عرض تصویرهای بندانگشتی';
$lang['admin']['thumbnail_height'] = 'بلندی تصویرهای بندانگشتی';
$lang['admin']['E_STRICT'] = 'Is E_STRICT disabled in error_reporting';
$lang['admin']['test_estrict_failed'] = 'E_STRICT is enabled in the error_reporting';
$lang['admin']['info_estrict_failed'] = 'Some libraries that CMSMS uses do not work well with E_STRICT.  Please disable this before continuing';
$lang['admin']['E_DEPRECATED'] = 'Is E_DEPRECATED disabled in error_reporting';
$lang['admin']['test_edeprecated_failed'] = 'E_DEPRECATED is enabled';
$lang['admin']['info_edeprecated_failed'] = 'If E_DEPRECATED is enabled in your error reporting users will see alot of warning messages that could effect the display and functionalty';
$lang['admin']['session_use_cookies'] = 'Sessions are allowed to use Cookies';
$lang['admin']['errorgettingcontent'] = 'Could not retrieve information for the specified content object';
$lang['admin']['errordeletingcontent'] = 'Error deleting content (either this page has children or is the default content)';
$lang['admin']['invalidemail'] = 'آدرس پست الکترونیکی وارد شده معتبر نیست';
$lang['admin']['info_deletepages'] = 'توجه: بر اساس سطح&zwnj;های دسترسی تعیین شده،ممکن است برخی از صفحه&zwnj;های انتخاب شده برای حذف در فهرست ذیل نباشند.';
$lang['admin']['info_pagealias'] = 'برای این صفحه یک نام مستعار اختصاص دهید.';
$lang['admin']['info_autoalias'] = 'اگر نام مستعاری انتصاب نشود، بصورت خودکار نام مستعاری در نظر گرفته می&zwnj;شود.';
$lang['admin']['invalidparent'] = 'شما باید یک صفحه را بعنوان صفحه اصلی انتخاب کنید (اگر این اختیار را ندارید، با مدیریت تماس بگیرید)';
$lang['admin']['forgotpwprompt'] = 'شناسه کاربری مدیر را وارد کنید. یک نامه به آدرس پست الکترونیک ارسال خواهد شد و توضیح&zwnj;هایی در آن برای ورود به سامانه خواهد بود.';
$lang['admin']['info_basic_attributes'] = 'اين گزينه به شما اين امکان را مي دهد تا مشخص نماييد کاربران کدام ويژگي صفحه را مي توانند ويرايش کنند.';
$lang['admin']['basic_attributes'] = 'ويژگيهاي پايه';
$lang['admin']['no_permission'] = 'شما اجازه اجراي اين تابع را نداريد';
$lang['admin']['bulk_success'] = 'عمليات درخواستی شما با موفقيت انجام شد';
$lang['admin']['no_bulk_performed'] = 'هيچ عملياتی انجام نشد';
$lang['admin']['info_preview_notice'] = 'اخطار : اين پنل بسيار شبيه به پنجره مرورگر کار مي کند و به شما اجازه مي دهد که در صفحاتي که به صورت پيش  نمايشي ساخته شده اند حرکت کنيد. با اين وجود ممکن است نتيجه اي که مشاهده مي کنيد مطابق با انتظارات شما نباشد. در صورتيکه صفحه جديدي اضافه شود، تا زمانيکه اين پنل بارگذاري مجدد نشود، در پيش نمايش قابل مشاهده نمي باشد';
$lang['admin']['sitedownexcludes'] = 'به این آدرس ها پیام تعطیلی سایت را نشان نده';
$lang['admin']['info_sitedownexcludes'] = '<span dir=&quot;rtl&quot;>اين پارامتر به شما اجازه مي دهد که آدرسها و يا شبکه هايي که نمي بايست از الگوي تعطیلی سایت تبعيت کنند را با فرمت </span><span dir=&quot;rtl&quot;> CSV </span><span dir=&quot;rtl&quot;><span dir=&quot;rtl&quot;> </span>مشخص نماييد. اين باعث مي شود تا مديران سيستم به رفع مشکل بپردازند در حاليکه بازديدکنندگان ناشناس پيام تعطیلی سایت را مشاهد می کنند</span>
<br/><br/>
آدرسها مي توانند بر اساس الگوهاي زير تعريف شوند
<br/>
1. xxx.xxx.xxx.xxx -- (exact IP address)<br/>
2. xxx.xxx.xxx.[yyy-zzz] -- (IP address range)<br/>
3. xxx.xxx.xxx.xxx/nn -- (nnn = number of bits, cisco style.  i.e:  192.168.0.100/24 = entire 192.168.0 class C subnet)';
$lang['admin']['setup'] = 'تنظيمات پيشرفته';
$lang['admin']['handle_404'] = 'Custom 404 Handling';
$lang['admin']['sitedown_settings'] = 'Sitedown Settings';
$lang['admin']['general_settings'] = 'General Settings';
$lang['admin']['help_function_page_attr'] = '<h3>What does this do?</h3>
<p>This tag can be used to return the value of the attributes of a certain page.</p>
<h3>How do I use it?</h3>
<p>Insert the tag into the template like: <code>{page_attr key=&quot;extra1&quot;}</code>.</p>
<h3>What parameters does it take?</h3>
<ul>
  <li><strong>key [required]</strong> The key to return the attribute of.</li>
</ul>';
$lang['admin']['forge'] = 'Forge';
$lang['admin']['disable_wysiwyg'] = 'Disable WYSIWYG editor on this page (regardless of template or user settings)';
$lang['admin']['help_function_page_image'] = '<h3>What does this do?</h3>
<p>This tag can be used to return the value of the image or thumbnail fields of a certain page.</p>
<h3>How do I use it?</h3>
<p>Insert the tag into the template like: <code>{page_image}</code>.</p>
<h3>What parameters does it take?</h3>
<ul>
  <li>thumbnail - Optionally display the value of the thumbnail property instead of the image property.</li>
</ul>';
$lang['admin']['pagelink_circular'] = 'A page link cannot list another page link as its destination';
$lang['admin']['destinationnotfound'] = 'The selected page could not be found or is invalid';
$lang['admin']['help_function_dump'] = '<h3>What does this do?</h3>
  <p>This tag can be used to dump the contents of any smarty variable in a more readable format.  This is useful for debugging, and editing templates, to know the format and types of data available.</p>
<h3>How do I use it?</h3>
<p>Insert the tag in the template like <code>{dump item=&#039;the_smarty_variable_to_dump&#039;}</code>.</p>
<h3>What parameters does it take?</h3>
<ul>
<li><strong>item (required)</strong> - The smarty variable to dump the contents of.</li>
<li>maxlevel - The maximum number of levels to recurse (applicable only if recurse is also supplied.  The default value for this parameter is 3</li>
<li>nomethods - Skip output of methods from objects.</li>
<li>novars - Skip output of object members.</li>
<li>recurse - Recurse a maximum number of levels through the objects providing verbose output for each item until the maximum number of levels is reached.</li>
</ul>';
$lang['admin']['sqlerror'] = 'SQL error in %s';
$lang['admin']['image'] = 'Image';
$lang['admin']['thumbnail'] = 'Thumbnail';
$lang['admin']['searchable'] = 'This page is searchable';
$lang['admin']['help_function_content_image'] = '<h3>What does this do?</h3>
<p>This plugin allows template designers to prompt users to select an image file when editing the content of a page. It behaves similarly to the content plugin, for additional content blocks.</p>
<h3>How do I use it?</h3>
<p>Just insert the tag into your page template like: <code>{content_image block=&#039;image1&#039;}</code>.</p>
<h3>What parameters does it take?</h3>
<ul>
  <li><strong>(required)</strong> block - The name for this additional content block.
  <p>Example:</p>
  <pre>{content_image block=&#039;image1&#039;}</pre><br/>
  </li>

  <li><em>(optional)</em> label - A label or prompt for this content block in the edit content page.  If not specified, the block name will be used.</li>
 
  <li><em>(optional)</em> dir - The name of a directory (relative to the uploads directory, from which to select image files. If not specified, the uploads directory will be used.
  <p>Example: use images from the uploads/image directory.</p>
  <pre>{content_image block=&#039;image1&#039; dir=&#039;images&#039;}</pre><br/>
  </li>

  <li><em>(optional)</em> class - The css class name to use on the img tag in frontend display.</li>

  <li><em>(optional)</em> id - The id name to use on the img tag in frontend display.</li> 

  <li><em>(optional)</em> name - The tag name to use on the img tag in frontend display.</li> 

  <li><em>(optional)</em> width - The desired width of the image.</li>

  <li><em>(optional)</em> height - The desired height of the image.</li>

  <li><em>(optional)</em> alt - Alternative text if the image cannot be found.</li>
  <li><em>(optional)</em> urlonly - output only the url to the image, ignoring all parameters like id, name, width, height, etc.</li>
</ul>';
$lang['admin']['error_udt_name_chars'] = 'A valid UDT name starts with a letter or underscore, followed by any number of letters, numbers, or underscores.';
$lang['admin']['errorupdatetemplateallpages'] = 'Template is not active';
$lang['admin']['hidefrommenu'] = 'Hide From Menu';
$lang['admin']['settemplate'] = 'Set Template';
$lang['admin']['text_settemplate'] = 'Set Selected Pages to a different Template';
$lang['admin']['cachable'] = 'Cachable';
$lang['admin']['noncachable'] = 'Non Cachable';
$lang['admin']['copy_from'] = 'کپی از';
$lang['admin']['copy_to'] = 'کپی به';
$lang['admin']['copycontent'] = 'Copy Content Item';
$lang['admin']['md5_function'] = 'md5 function';
$lang['admin']['tempnam_function'] = 'tempnam function';
$lang['admin']['register_globals'] = 'PHP register_globals';
$lang['admin']['output_buffering'] = 'PHP output_buffering';
$lang['admin']['disable_functions'] = 'disable_functions in PHP';
$lang['admin']['xml_function'] = 'Basic XML (expat) support';
$lang['admin']['magic_quotes_gpc'] = 'Magic quotes for Get/Post/Cookie';
$lang['admin']['magic_quotes_gpc_on'] = 'Single-quote, double quote and backslash are escaped automatically. You can experience problems when saving templates';
$lang['admin']['magic_quotes_runtime'] = 'Magic quotes in runtime';
$lang['admin']['magic_quotes_runtime_on'] = 'Most functions that return data will have quotes escaped with a backslash. You can experience problems';
$lang['admin']['file_get_contents'] = 'Test file_get_contents';
$lang['admin']['check_ini_set'] = 'Test ini_set';
$lang['admin']['check_ini_set_off'] = 'You may have difficulty with some functionality without this capability. This test may fail if safe_mode is enabled';
$lang['admin']['file_uploads'] = 'File uploads';
$lang['admin']['test_remote_url'] = 'Test for remote URL';
$lang['admin']['test_remote_url_failed'] = 'You will probably not be able to open a file on a remote web server.';
$lang['admin']['test_allow_url_fopen_failed'] = 'When allow url fopen is disabled you will not be able to accessing URL object like file using the ftp or http protocol.';
$lang['admin']['connection_error'] = 'Outgoing http connections do not appear to work! There is a firewall or some ACL for external connections?. This will result in module manager, and potentially other functionality failing.';
$lang['admin']['remote_connection_timeout'] = 'Connection Timed Out!';
$lang['admin']['search_string_find'] = 'Connection ok!';
$lang['admin']['connection_failed'] = 'Connection failed!';
$lang['admin']['remote_response_ok'] = 'Remote response: ok!';
$lang['admin']['remote_response_404'] = 'Remote response: not found!';
$lang['admin']['remote_response_error'] = 'Remote response: error!';
$lang['admin']['notifications_to_handle'] = 'You have <b>%d</b> unhandled notifications';
$lang['admin']['notification_to_handle'] = 'You have <b>%d</b> unhandled notification';
$lang['admin']['notifications'] = 'Notifications';
$lang['admin']['dashboard'] = 'View Dashboard';
$lang['admin']['ignorenotificationsfrommodules'] = 'Ignore notifications from these modules';
$lang['admin']['admin_enablenotifications'] = 'Allow users to view notifications<br/><em>(notifications will be displayed on all admin pages)</em>';
$lang['admin']['enablenotifications'] = 'Enable user notifications in the admin section';
$lang['admin']['test_check_open_basedir_failed'] = 'Open basedir restrictions are in effect. You may have difficulty with some addon functionality with this restriction';
$lang['admin']['config_writable'] = 'config.php writable. It is more safe if you change permission to read-only';
$lang['admin']['caution'] = 'Caution';
$lang['admin']['create_dir_and_file'] = 'Checking if the httpd process can create a file inside of a directory it created';
$lang['admin']['os_session_save_path'] = 'No check because OS path';
$lang['admin']['unlimited'] = 'Unlimited';
$lang['admin']['open_basedir'] = 'PHP Open Basedir';
$lang['admin']['open_basedir_active'] = 'No check because open basedir active';
$lang['admin']['invalid'] = 'Invalid';
$lang['admin']['checksum_passed'] = 'All checksums match those in the uploaded file';
$lang['admin']['error_retrieving_file_list'] = 'Error retrieving file list';
$lang['admin']['files_checksum_failed'] = 'Files could not be checksummed';
$lang['admin']['failure'] = 'Failure';
$lang['admin']['help_function_process_pagedata'] = '<h3>What does this do?</h3>
<p>This plugin will process the data in the &quot;pagedata&quot; block of content pages through smarty.  It allows you to specify page specific data to smarty without changing the template for each page.</p>
<h3>How do I use it?</h3>
<ol>
  <li>Insert smarty assign variables and other smarty logic into the pagedata field of some of your content pages.</li>
  <li>Insert the <code>{process_pagedata}</code> tag into the very top of your page template.</li>
</ol>
<br/>
<h3>What parameters does it take?</h3>
<p>None at this time</p>';
$lang['admin']['page_metadata'] = 'Page Specific Metadata';
$lang['admin']['pagedata_codeblock'] = 'Smarty data or logic that is specific to this page';
$lang['admin']['error_uploadproblem'] = 'An error occurred in the upload';
$lang['admin']['error_nofileuploaded'] = 'No File has been uploaded';
$lang['admin']['files_failed'] = 'Files failed md5sum check';
$lang['admin']['files_not_found'] = 'Files Not found';
$lang['admin']['info_generate_cksum_file'] = 'This function will allow you to generate a checksum file and save it on your local computer for later validation.  This should be done just prior to rolling out the website, and/or after any upgrades, or major modifications.';
$lang['admin']['info_validation'] = 'This function will compare the checksums found in the uploaded file with the files on the current installation.  It can assist in finding problems with uploads, or exactly what files were modified if your system has been hacked.  A checksum file is generated for each release of CMS Made simple from version 1.4 on.';
$lang['admin']['download_cksum_file'] = 'Download Checksum File';
$lang['admin']['perform_validation'] = 'Perform Validation';
$lang['admin']['upload_cksum_file'] = 'Upload Checksum File';
$lang['admin']['checksumdescription'] = 'Validate the integrity of CMS files by comparing against known checksums';
$lang['admin']['system_verification'] = 'System Verification';
$lang['admin']['extra1'] = 'Extra Page Attribute 1';
$lang['admin']['extra2'] = 'Extra Page Attribute 2';
$lang['admin']['extra3'] = 'Extra Page Attribute 3';
$lang['admin']['start_upgrade_process'] = 'Start Upgrade Process';
$lang['admin']['warning_upgrade'] = '<em><strong>Warning:</strong></em> CMSMS is in need of an upgrade.';
$lang['admin']['warning_upgrade_info1'] = 'You are now running schema version %s. and you need to be upgraded to version %s';
$lang['admin']['warning_upgrade_info2'] = 'Please click the following link: %s.';
$lang['admin']['warning_mail_settings'] = 'Your mail settings have not been configured.  This could interfere with the ability of your website to send email messages.  You should go to <a href="%s">Extensions >> CMSMailer</a> and configure the mail settings with the information provided by your host.';
$lang['admin']['view_page'] = 'View this page in a new window';
$lang['admin']['off'] = 'خاموش';
$lang['admin']['on'] = 'روشن';
$lang['admin']['invalid_test'] = 'Invalid test param value!';
$lang['admin']['copy_paste_forum'] = 'View Text Report <em>(suitable for copying into forum posts)</em>';
$lang['admin']['permission_information'] = 'Permission Information';
$lang['admin']['server_os'] = 'Server Operating System';
$lang['admin']['server_api'] = 'Server API';
$lang['admin']['server_software'] = 'Server Software';
$lang['admin']['server_information'] = 'Server Information';
$lang['admin']['session_save_path'] = 'Session Save Path';
$lang['admin']['max_execution_time'] = 'Maximum Execution Time';
$lang['admin']['gd_version'] = 'GD version';
$lang['admin']['upload_max_filesize'] = 'Maximum Upload Size';
$lang['admin']['post_max_size'] = 'Maximum Post Size';
$lang['admin']['memory_limit'] = 'PHP Effective Memory Limit';
$lang['admin']['server_db_type'] = 'Server Database';
$lang['admin']['server_db_version'] = 'Server Database Version';
$lang['admin']['phpversion'] = 'Current PHP Version';
$lang['admin']['safe_mode'] = 'PHP Safe Mode';
$lang['admin']['php_information'] = 'PHP Information';
$lang['admin']['cms_install_information'] = 'CMSMS Install Information';
$lang['admin']['cms_version'] = 'CMS Version';
$lang['admin']['installed_modules'] = 'Installed Modules';
$lang['admin']['config_information'] = 'Config Information';
$lang['admin']['systeminfo_copy_paste'] = 'Please copy and paste this selected text into your forum posting';
$lang['admin']['help_systeminformation'] = 'The information displayed below is collected from a variety of locations, and summarized here so that you may be able to conveniently find some of the information required when trying to diagnose a problem or request help with your CMS Made Simple installation.';
$lang['admin']['systeminfo'] = 'System Information';
$lang['admin']['systeminfodescription'] = 'Display various pieces of information about your system that may be useful in diagnosing problems';
$lang['admin']['welcome_user'] = 'Welcome';
$lang['admin']['itsbeensincelogin'] = 'It has been %s since you last logged in';
$lang['admin']['days'] = 'روزها';
$lang['admin']['day'] = 'روز';
$lang['admin']['hours'] = 'ساعت ها';
$lang['admin']['hour'] = 'ساعت';
$lang['admin']['minutes'] = 'دقیقه ها';
$lang['admin']['minute'] = 'دقیقه';
$lang['admin']['help_css_max_age'] = 'This parameter should be set relatively high for static sites, and should be set to 0 for site development';
$lang['admin']['css_max_age'] = 'Maximum amount of time (seconds) stylesheets can be cached in the browser';
$lang['admin']['error'] = 'خطا';
$lang['admin']['new_version_available'] = '<em>Notice:</em> A new version of CMS Made Simple is available.  Please notify your administrator.';
$lang['admin']['master_admintheme'] = 'Default Administration Theme (for the login page and new user accounts)';
$lang['admin']['contenttype_separator'] = 'Separator';
$lang['admin']['contenttype_sectionheader'] = 'Section Header';
$lang['admin']['contenttype_content'] = 'محتوا';
$lang['admin']['contenttype_pagelink'] = 'Internal Page Link';
$lang['admin']['nogcbwysiwyg'] = 'Disallow WYSIWYG editors on global content blocks';
$lang['admin']['destination_page'] = 'Destination Page';
$lang['admin']['additional_params'] = 'Additional Parameters';
$lang['admin']['help_function_current_date'] = '	<h3>What does this do?</h3>
	<p>Prints the current date and time.  If no format is given, it will default to a format similar to &#039;Jan 01, 2004&#039;.</p>
	<h3>How do I use it?</h3>
	<p>Just insert the tag into your template/page like: <code>{current_date format=&quot;%A %d-%b-%y %T %Z&quot;}</code></p>
	<h3>What parameters does it take?</h3>
	<ul>
		<li><em>(optional)</em>format - Date/Time format using parameters from php&#039;s strftime function.  See <a href="http://php.net/strftime" target="_blank">here</a> for a parameter list and information.</li>
		<li><em>(optional)</em>ucword - If true return uppercase the first character of each word.</li>
	</ul>';
$lang['admin']['help_function_valid_xhtml'] = '<h3>What does this do?</h3>
<p>Returns a link to the w3c HTML validator.</p>
<h3>How do I use it?</h3>
<p>Just insert the tag into your template/page like: <code>{valid_xhtml}</code></p>
<h3>What parameters does it take?</h3>
    <ul>
	<li><em>(optional)</em> url         (string)     - The URL used for validation, if none is given http://validator.w3.org/check/referer is used.</li>
	<li><em>(optional)</em> class       (string)     - If set, this will be used as class attribute for the link (a) element</li>
	<li><em>(optional)</em> target      (string)     - If set, this will be used as target attribute for the link (a) element</li>
	<li><em>(optional)</em> image       (true/false) - If set to false, a text link will be used instead of an image/icon.</li>
	<li><em>(optional)</em> text        (string)     - If set, this will be used for the link text or alternate text for the image. Default is &#039;valid XHTML 1.0 Transitional&#039;.<br /> When an image is used, the given string will also be used for the image alt attribute (by default, this can be overridden by using the &#039;alt&#039; parameter).</li>
	<li><em>(optional)</em> image_class (string)     - Only if &#039;image&#039; is not set to false. If set, this will be used as class attribute for the image (img) element</li>
	<li><em>(optional)</em> src         (string)     - Only if &#039;image&#039; is not set to false. The icon to show. Default is http://www.w3.org/Icons/valid-xhtml10</li>
	<li><em>(optional)</em> width       (string)     - Only if &#039;image&#039; is not set to false. The image width. Default is 88 (width of http://www.w3.org/Icons/valid-xhtml10)</li>
	<li><em>(optional)</em> height      (string)     - Only if &#039;image&#039; is not set to false. The image height. Default is 31 (height of http://www.w3.org/Icons/valid-xhtml10)</li>
	<li><em>(optional)</em> alt         (string)     - Only if &#039;image&#039; is not set to false. The alternate text (&#039;alt&#039; attribute) for the image (element). If none is given the link text will be used.</li>
    </ul>';
$lang['admin']['help_function_valid_css'] = '<h3>What does this do?</h3>
<p>Returns a link to the w3c CSS validator.</p>
<h3>How do I use it?</h3>
<p>Just insert the tag into your template/page like: <code>{valid_css}</code></p>
<h3>What parameters does it take?</h3>
    <ul>
        <li><em>(optional)</em> url         (string)     - The URL used for validation, if none is given http://jigsaw.w3.org/css-validator/check/referer is used.</li>
	<li><em>(optional)</em> class       (string)     - If set, this will be used as class attribute for the link (a) element</li>
	<li><em>(optional)</em> target      (string)     - If set, this will be used as target attribute for the link (a) element</li>
	<li><em>(optional)</em> image       (true/false) - If set to false, a text link will be used instead of an image/icon.</li>
	<li><em>(optional)</em> text        (string)     - If set, this will be used for the link text or alternate text for the image. Default is &#039;Valid CSS 2.1&#039;.<br /> When an image is used, the given string will also be used for the image alt attribute (by default, this can be overridden by using the &#039;alt&#039; parameter).</li>
	<li><em>(optional)</em> image_class (string)     - Only if &#039;image&#039; is not set to false. If set, this will be used as class attribute for the image (img) element</li>
        <li><em>(optional)</em> src         (string)     - Only if &#039;image&#039; is not set to false. The icon to show. Default is http://jigsaw.w3.org/css-validator/images/vcss</li>
        <li><em>(optional)</em> width       (string)     - Only if &#039;image&#039; is not set to false. The image width. Default is 88 (width of http://jigsaw.w3.org/css-validator/images/vcss)</li>
        <li><em>(optional)</em> height      (string)     - Only if &#039;image&#039; is not set to false. The image height. Default is 31 (height of http://jigsaw.w3.org/css-validator/images/vcss)</li>
	<li><em>(optional)</em> alt         (string)     - Only if &#039;image&#039; is not set to false. The alternate text (&#039;alt&#039; attribute) for the image (element). If none is given the link text will be used.</li>
    </ul>';
$lang['admin']['help_function_title'] = '	<h3>What does this do?</h3>
	<p>Prints the title of the page.</p>
	<h3>How do I use it?</h3>
	<p>Just insert the tag into your template/page like: <code>{title}</code></p>
	<h3>What parameters does it take?</h3>
	<p><em>(optional)</em> assign (string) - Assign the results to a smarty variable with that name.</p>';
$lang['admin']['help_function_stylesheet'] = '	<h3>What does this do?</h3>
	<p>Gets stylesheet information from the system.  By default, it grabs all of the stylesheets attached to the current template.</p>
	<h3>How do I use it?</h3>
	<p>Just insert the tag into your template/page&#039;s head section like: <code>{stylesheet}</code></p>
	<h3>What parameters does it take?</h3>
	<ul>
		<li><em>(optional)</em>name - Instead of getting all stylesheets for the given page, it will only get one spefically named one, whether it&#039;s attached to the current template or not.</li>
		<li><em>(optional)</em>media - If name is defined, this allows you set a different media type for that stylesheet.</li>
    <li><em>(optional)</em>templateid - If templateid is defined, this will return stylesheets associated with that template instead of the current one.</li>
	</ul>';
$lang['admin']['help_function_sitename'] = '        <h3>What does this do?</h3>
        <p>Shows the name of the site.  This is defined during install and can be modified in the Global Settings section of the admin panel.</p>
        <h3>How do I use it?</h3>
        <p>Just insert the tag into your template/page like: <code>{sitename}</code></p>
        <h3>What parameters does it take?</h3>
	<p><em>(optional)</em> assign (string) - Assign the results to a smarty variable with that name.</p>';
$lang['admin']['help_function_search'] = '	<h3>What does this do?</h3>
	<p>This is actually just a wrapper tag for the Search module to make the tag syntax easier. 
	Instead of having to use <code>{cms_module module=&#039;Search&#039;}</code> you can now just use <code>{search}</code> to insert the module in a template.
	</p>
	<h3>How do I use it?</h3>
	<p>Just put <code>{search}</code> in a template where you want the search input box to appear. For help about the Search module, please refer to the Search module help.</p>';
$lang['admin']['help_function_root_url'] = '	<h3>What does this do?</h3>
	<p>Prints the root url location for the site.</p>
	<h3>How do I use it?</h3>
	<p>Just insert the tag into your template/page like: <code>{root_url}</code></p>
	<h3>What parameters does it take?</h3>
	<p>None at this time.</p>';
$lang['admin']['help_function_repeat'] = '  <h3>What does this do?</h3>
  <p>Repeats a specified sequence of characters, a specified number of times</p>
  <h3>How do I use it?</h3>
  <p>Insert a tag similar to the following into your template/page, like this: <code>{repeat string=&#039;repeat this &#039; times=&#039;3&#039;}</code></p>
  <h3>What parameters does it take?</h3>
  <ul>
  <li>string=&#039;text&#039; - The string to repeat</li>
  <li>times=&#039;num&#039; - The number of times to repeat it.</li>
  </ul>';
$lang['admin']['help_function_recently_updated'] = '	<h3>What does this do?</h3>
	<p>Outputs a list of recently updated pages.</p>
	<h3>How do I use it?</h3>
	<p>Just insert the tag into your template/page like: <code>{recently_updated}</code></p>
	<h3>What parameters does it take?</h3>
	<ul>
	 <li><p><em>(optional)</em> number=&#039;10&#039; - Number of updated pages to show.</p><p>Example: {recently_updated number=&#039;15&#039;}</p></li>
 	 <li><p><em>(optional)</em> leadin=&#039;Last changed&#039; - Text to show left of the modified date.</p><p>Example: {recently_updated leadin=&#039;Last Changed&#039;}</p></li>
 	 <li><p><em>(optional)</em> showtitle=&#039;true&#039; - Shows the titleattribute if it exists as well (true|false).</p><p>Example: {recently_updated showtitle=&#039;true&#039;}</p></li>											 	
	 <li><p><em>(optional)</em> css_class=&#039;some_name&#039; - Warp a div tag with this class around the list.</p><p>Example: {recently_updated css_class=&#039;some_name&#039;}</p></li>											 	
	 <li><p><em>(optional)</em> dateformat=&#039;d.m.y h:m&#039; - default is d.m.y h:m , use the format you whish (php -date- format)</p><p>Example: {recently_updated dateformat=&#039;D M j G:i:s T Y&#039;}</p></li>											 	
	</ul>
	<p>or combined:</p>
	<pre>{recently_updated number=&#039;15&#039; showtitle=&#039;false&#039; leadin=&#039;Last Change: &#039; css_class=&#039;my_changes&#039; dateformat=&#039;D M j G:i:s T Y&#039;}</pre>';
$lang['admin']['help_function_print'] = '	<h3>What does this do?</h3>
	<p>This is actually just a wrapper tag for the Printing module to make the tag syntax easier. 
	Instead of having to use <code>{cms_module module=&#039;Printing&#039;}</code> you can now just use <code>{print}</code> to insert the module on pages and templates.
	</p>
	<h3>How do I use it?</h3>
	<p>Just put <code>{print}</code> on a page or in a template. For help about the Printing module, what parameters it takes etc., please refer to the Printing module help.</p>';
$lang['admin']['login_info_title'] = 'Information';
$lang['admin']['login_info'] = 'For the Admin console to work properly';
$lang['admin']['login_info_params'] = '<ol> 
  <li>Cookies must be enabled in your browser</li> 
  <li>Javascript must be enabled in your browser</li> 
  <li>Popup windows must be allowed for the following address:</li> 
</ol>';
$lang['admin']['help_function_news'] = '	<h3>What does this do?</h3>
	<p>This is actually just a wrapper tag for the News module to make the tag syntax easier. 
	Instead of having to use <code>{cms_module module=&#039;News&#039;}</code> you can now just use <code>{news}</code> to insert the module on pages and templates.
	</p>
	<h3>How do I use it?</h3>
	<p>Just put <code>{news}</code> on a page or in a template. For help about the News module, what parameters it takes etc., please refer to the News module help.</p>';
$lang['admin']['help_function_modified_date'] = '        <h3>What does this do?</h3>
        <p>Prints the date and time the page was last modified.  If no format is given, it will default to a format similar to &#039;Jan 01, 2004&#039;.</p>
        <h3>How do I use it?</h3>
        <p>Just insert the tag into your template/page like: <code>{modified_date format=&quot;%A %d-%b-%y %T %Z&quot;}</code></p>
        <h3>What parameters does it take?</h3>
        <ul>
                <li><em>(optional)</em>format - Date/Time format using parameters from php&#039;s strftime function.  See <a href="http://php.net/strftime" target="_blank">here</a> for a parameter list and information.</li>
        </ul>';
$lang['admin']['help_function_metadata'] = '	<h3>What does this do?</h3>
	<p>Displays the metadata for this page. Both global metdata from the global settings page and metadata for each page will be shown.</p>
	<h3>How do I use it?</h3>
	<p>Just insert the tag into your template like: <code>{metadata}</code></p>
	<h3>What parameters does it take?</h3>
	<ul>
		<li><em>(optional)</em>showbase (true/false) - If set to false, the base tag will not be sent to the browser.  Defaults to true if use_hierarchy is set to true in config.php.</li>
	</ul>';
$lang['admin']['help_function_menu_text'] = '	<h3>What does this do?</h3>
	<p>Prints the menu text of the page.</p>
	<h3>How do I use it?</h3>
	<p>Just insert the tag into your template/page like: <code>{menu_text}</code></p>
	<h3>What parameters does it take?</h3>
	<p>None at this time.</p>';
$lang['admin']['help_function_menu'] = '	<h3>What does this do?</h3>
	<p>This is actually just a wrapper tag for the Menu Manager module to make the tag syntax easier. 
	Instead of having to use <code>{cms_module module=&#039;MenuManager&#039;}</code> you can now just use <code>{menu}</code> to insert the module on pages and templates.
	</p>
	<h3>How do I use it?</h3>
	<p>Just put <code>{menu}</code> on a page or in a template. For help about the Menu Manager module, what parameters it takes etc., please refer to the Menu Manager module help.</p>';
$lang['admin']['help_function_last_modified_by'] = '        <h3>What does this do?</h3>
        <p>Prints last person that edited this page.  If no format is given, it will default to a ID number of user .</p>
        <h3>How do I use it?</h3>
        <p>Just insert the tag into your template/page like: <code>{last_modified_by format=&quot;fullname&quot;}</code></p>
        <h3>What parameters does it take?</h3>
        <ul>
                <li><em>(optional)</em>format - id, username, fullname</li>
        </ul>';
$lang['admin']['help_function_image'] = '  <h3>What does this do?</h3>
  <p>Creates an image tag to an image stored within your images directory</p>
  <h3>How do I use it?</h3>
  <p>Just insert the tag into your template/page like: <code>{image src=&quot;something.jpg&quot;}</code></p>
  <h3>What parameters does it take?</h3>
  <ul>
     <li><em>(required)</em>  <tt>src</tt> - Image filename within your images directory.</li>
     <li><em>(optional)</em>  <tt>width</tt> - Width of the image within the page. Defaults to true size.</li>
     <li><em>(optional)</em>  <tt>height</tt> - Height of the image within the page. Defaults to true size.</li>
     <li><em>(optional)</em>  <tt>alt</tt> - Alt text for the image -- needed for xhtml compliance. Defaults to filename.</li>
     <li><em>(optional)</em>  <tt>class</tt> - CSS class for the image.</li>
     <li><em>(optional)</em>  <tt>title</tt> - Mouse over text for the image. Defaults to Alt text.</li>
     <li><em>(optional)</em>  <tt>addtext</tt> - Additional text to put into the tag</li>
  </ul>';
$lang['admin']['help_function_html_blob'] = '	<h3>What does this do?</h3>
	<p>See the help for global_content for a description.</p>';
$lang['admin']['help_function_google_search'] = '	<h3>What does this do?</h3>
	<p>Search&#039;s your website using Google&#039;s search engine.</p>
	<h3>How do I use it?</h3>
	<p>Just insert the tag into your template/page like: <code>{google_search}</code><br />
	<br />
	Note: Google needs to have your website indexed for this to work. You can submit your website to google <a href="http://www.google.com/addurl.html">here</a>.</p>
	<h3>What if I want to change the look of the textbox or button?</h3>
	<p>The look of the textbox and button can be changed via css. The textbox is given an id of textSearch and the button is given an id of buttonSearch.</p>

	<h3>What parameters does it take?</h3>
	<ul>
		<li><em>(optional)</em> domain - This tells google the website domain to search. This script tries to determine this automatically.</li>
		<li><em>(optional)</em> buttonText - The text you want to display on the search button. The default is &quot;Search Site&quot;.</li>
	</ul>';
$lang['admin']['help_function_global_content'] = '	<h3>What does this do?</h3>
	<p>Inserts a global content block into your template or page.</p>
	<h3>How do I use it?</h3>
	<p>Just insert the tag into your template/page like: <code>{global_content name=&#039;myblob&#039;}</code>, where name is the name given to the block when it was created.</p>
	<h3>What parameters does it take?</h3>
	<ul>
  	  <li>name - The name of the global content block to display.</li>
          <li><em>(optional)</em> assign - The name of a smarty variable that the global content block should be assigned to.</li>
	</ul>';
$lang['admin']['help_function_get_template_vars'] = '	<h3>What does this do?</h3>
	<p>Dumps all the known smarty variables into your page</p>
	<h3>How do I use it?</h3>
	<p>Just insert the tag into your template/page like: <code>{get_template_vars}</code></p>
	<h3>What parameters does it take?</h3>
											  <p>None at this time</p>';
$lang['admin']['help_function_uploads_url'] = '	<h3>What does this do?</h3>
	<p>Prints the uploads url location for the site.</p>
	<h3>How do I use it?</h3>
	<p>Just insert the tag into your template/page like: <code>{uploads_url}</code></p>
	<h3>What parameters does it take?</h3>
	<p><em>(optional)</em> assign (string) - Assign the results to a smarty variable with that name.</p>';
$lang['admin']['help_function_embed'] = '	<h3>What does this do?</h3>
	<p>Enable inclusion (embeding) of any other application into the CMS. The most usual use could be a forum. 
	This implementation is using IFRAMES so older browsers can have problems. Sorry bu this is the only known way 
	that works without modifing the embeded application.</p>
	<h3>How do I use it?</h3>
        <ul>
        <li>a) Add <code>{embed header=true}</code> into the head section of your page template, or into the metadata section in the options tab of a content page.  This will ensure that the required javascript gets included.   If you insert this tag into the metadata section in the options tab of a content page you must ensure that <code>{metadata}</code> is in your page template.</li>
        <li>b) Add <code>{embed url=&quot;http://www.google.com&quot;}</code> into your page content or in the body of your page template.</li>
        </ul>
        <br/>
        <h4>Example to make the iframe larger</h4>
	<p>Add the following to your style sheet:</p>
        <pre>#myframe { height: 600px; }</pre>
        <br/>
        <h3>What parameters does it take?</h3>
        <ul>
            <li><em>(required)</em>url - the url to be included</li> 
            <li><em>(required)</em>header=true - this will generate the header code for good resizing of the IFRAME.</li>
            <li>(optional)name - an optional name to use for the iframe (instead of myframe).<p>If this option is used, it must be used identically in both calls, i.e: {embed header=true name=foo} and {embed name=foo url=http://www.google.com} calls.</p></li>
        </ul>';
$lang['admin']['help_function_description'] = '	<h3>What does this do?</h3>
	<p>Prints the description (title attribute) of the page.</p>
	<h3>How do I use it?</h3>
	<p>Just insert the tag into your template/page like: <code>{description}</code></p>
	<h3>What parameters does it take?</h3>
	<p>None at this time.</p>';
$lang['admin']['help_function_created_date'] = '        <h3>What does this do?</h3>
        <p>Prints the date and time the page was created.  If no format is given, it will default to a format similar to &#039;Jan 01, 2004&#039;.</p>
        <h3>How do I use it?</h3>
        <p>Just insert the tag into your template/page like: <code>{created_date format=&quot;%A %d-%b-%y %T %Z&quot;}</code></p>
        <h3>What parameters does it take?</h3>
        <ul>
                <li><em>(optional)</em>format - Date/Time format using parameters from php&#039;s strftime function.  See <a href="http://php.net/strftime" target="_blank">here</a> for a parameter list and information.</li>
        </ul>';
$lang['admin']['help_function_content'] = '	<h3>What does this do?</h3>
	<p>This is where the content for your page will be displayed.  It&#039;s inserted into the template and changed based on the current page being displayed.</p>
	<h3>How do I use it?</h3>
	<p>Just insert the tag into your template like: <code>{content}</code>.</p>
	<h3>What parameters does it take?</h3>
	<ul>
		<li><em>(optional)</em>block - Allows you to have more than one content block per page.  When multiple content tags are put on a template, that number of edit boxes will be displayed when the page is edited.
<p>Example:</p>
<pre>{content block=&quot;Second Content Block&quot;}</pre>
<p>Now, when you edit a page there will a textarea called &quot;Second Content Block&quot;.</p></li>
		<li><em>(optional)</em>wysiwyg (true/false) - If set to false, then a wysiwyg will never be used while editing this block.  If true, then it acts as normal.  Only works when block parameter is used.</li>
		<li><em>(optional)</em>oneline (true/false) - If set to true, then only one edit line will be shown while editing this block.  If false, then it acts as normal.  Only works when block parameter is used.</li>
<li><em>(optional)</em>size - Applicable only when the oneline option is used this optional parameter allows you to specify the size of the edit field.  The default value is 50.</li>
		<li><em>(optional)</em>default - Allows you to specify default content for this content blocks (additional content blocks only).</li>
		<li><em>(optional)</em>assign - Assigns the content to a smarty parameter, which you can then use in other areas of the page, or use to test whether content exists in it or not.
<p>Example of passing page content to a User Defined Tag as a parameter:</p>
<pre>
         {content assign=pagecontent}
         {table_of_contents thepagecontent=&quot;$pagecontent&quot;}
</pre>
</li>
	</ul>';
$lang['admin']['help_function_contact_form'] = '  <h2>NOTE: This plugin is deprecated</h2>
  <h3>This plugin has been removed as of CMS made simple version 1.5</h3>';
$lang['admin']['help_function_cms_versionname'] = '	<h3>What does this do?</h3>
	<p>This tag is used to insert the current version name of CMS into your template or page.  It doesn&#039;t display any extra besides the version name.</p>
	<h3>How do I use it?</h3>
	<p>This is just a basic tag plugin.  You would insert it into your template or page like so: <code>{cms_versionname}</code></p>
	<h3>What parameters does it take?</h3>
	<p>It takes no parameters.</p>';
$lang['admin']['help_function_cms_version'] = '	<h3>What does this do?</h3>
	<p>This tag is used to insert the current version number of CMS into your template or page.  It doesn&#039;t display any extra besides the version number.</p>
	<h3>How do I use it?</h3>
	<p>This is just a basic tag plugin.  You would insert it into your template or page like so: <code>{cms_version}</code></p>
	<h3>What parameters does it take?</h3>
	<p>It takes no parameters.</p>';
$lang['admin']['about_function_cms_selflink'] = '		<p>Author: Ted Kulp <tedkulp@users.sf.net></p>
		<p>Version: 1.1</p>
		<p>Modified: Martin B. Vestergaard <mbv@nospam.dk></p>
		<p>Version: 1.41</p>
		<p>Modified: Russ Baldwin</p>
		<p>Version: 1.42</p>
		<p>Modified: Marcus Bointon <coolbru@users.sf.net></p>
		<p>Version: 1.43</p>
		<p>Modified: Tatu Wikman <tsw@backspace.fi></p>
		<p>Version: 1.44</p>
		<p>Modified: Hans Mogren <http://hans.bymarken.net/></p>
		<p>Version: 1.45</p>

		<p>
		Change History:<br/>
		1.46 - Fixes a problem with too many queries when using the dir=start option.<br/>
		1.45 - Added a new option for &quot;dir&quot;, &quot;up&quot;, for links to the parent page e.g. dir=&quot;up&quot; (Hans Mogren).<br />
		1.44 - Added new parameters &quot;ext&quot; and &quot;ext_info&quot; to allow external links with class=&quot;external&quot; and info text after the link, ugly hack but works thinking about rewriting this(Tatu Wikman)<br />
		1.43 - Added new parameters &quot;image&quot; and &quot;imageonly&quot; to allow attachment of images to be used for page links, either instead of or in addition to text links. (Marcus Bointon)<br />
		1.42 - Added new parameter &quot;anchorlink&quot; and a new option for &quot;dir&quot; namely, &quot;anchor&quot;, for internal page links. e.g. dir=&quot;anchor&quot; anchorlink=&quot;internal_link&quot;. (Russ)<br />
		1.41 - added new parameter &quot;href&quot; (LeisureLarry)<br />
		1.4 - fixed bug next/prev linking to non-content pages. (Thanks Teemu Koistinen for this fix)<br />
		1.3 - added option &quot;more&quot;<br />
		1.2 - by Martin B. Vestergaard
		<ul>
		<li>changed default text to Page Name (was Page Alias)</li>
		<li>added option dir=next/prev to display next or previous item in the hirachy - thanks to 100rk</li>
		<li>added option class to add a class= statement to the a-tag.</li>
		<li>added option menu to display menu-text in sted of Page Name</li>
		<li>added option lang to display link-labels in different languages</li>
		</ul>
		1.1 - Changed to new content system<br />
		1.0 - Initial release
		</p>';
$lang['admin']['help_function_cms_selflink'] = '		<h3>What does this do?</h3>
		<p>Creates a link to another CMSMS content page inside your template or content. Can also be used for external links with the ext parameter.</p>
		<h3>How do I use it?</h3>
		<p>Just insert the tag into your template/page like: <code>{cms_selflink page=&quot;1&quot;}</code> or  <code>{cms_selflink page=&quot;alias&quot;}</code></p>
		<h3>What parameters does it take?</h3>
		<ul>
		<li><em>(optional)</em> <tt>page</tt> - Page ID or alias to link to.</li>
		<li><em>(optional)</em> <tt>dir anchor (internal links)</tt> - New option for an internal page link. If this is used then <tt>anchorlink</tt> should be set to your link. </li> <!-- Russ - 25-04-2006 -->
		<li><em>(optional)</em> <tt>anchorlink</tt> - New paramater for an internal page link. If this is used then <tt>dir =&quot;anchor&quot;</tt> should also be set. No need to add the #, because it is added automatically.</li> <!-- Russ - 25-04-2006 -->
		<li><em>(optional)</em> <tt>urlparam</tt> - Specify additional parameters to the URL.  <strong>Do not use this in conjunction with the <em>anchorlink</em> parameter</strong></li>
		<li><em>(optional)</em> <tt>tabindex =&quot;a value&quot;</tt> - Set a tabindex for the link.</li> <!-- Russ - 22-06-2005 -->
		<li><em>(optional)</em> <tt>dir start/next/prev/up (previous)</tt> - Links to the default start page or the next or previous page, or the parent page (up). If this is used <tt>page</tt> should not be set.</li> <!-- mbv - 21-06-2005 -->
		</ul>
		<strong>Note!</strong> Only one of the above may be used in the same cms_selflink statement!!
		<ul>
		<li><em>(optional)</em> <tt>text</tt> - Text to show for the link.  If not given, the Page Name is used instead.</li>
		<li><em>(optional)</em> <tt>menu 1/0</tt> - If 1 the Menu Text is used for the link text instead of the Page Name</li> <!-- mbv - 21-06-2005 -->
		<li><em>(optional)</em> <tt>target</tt> - Optional target for the a link to point to.  Useful for frame and javascript situations.</li>
		<li><em>(optional)</em> <tt>class</tt> - Class for the <a> link. Useful for styling the link.</li> <!-- mbv - 21-06-2005 -->
		<li><em>(optional)</em> <tt>lang</tt> - Display link-labels  (&quot;Next Page&quot;/&quot;Previous Page&quot;) in different languages (0 for no label.) Danish (dk), English (en) or French (fr), for now.</li> <!-- mbv - 21-06-2005 -->
		<li><em>(optional)</em> <tt>id</tt> - Optional css_id for the <a> link.</li> <!-- mbv - 29-06-2005 -->
		<li><em>(optional)</em> <tt>more</tt> - place additional options inside the <a> link.</li> <!-- mbv - 29-06-2005 -->
		<li><em>(optional)</em> <tt>label</tt> - Label to use in with the link if applicable.</li>
		<li><em>(optional)</em> <tt>label_side left/right</tt> - Side of link to place the label (defaults to &quot;left&quot;).</li>
		<li><em>(optional)</em> <tt>title</tt> - Text to use in the title attribute.  If none is given, then the title of the page will be used for the title.</li>
		<li><em>(optional)</em> <tt>rellink 1/0</tt> - Make a relational link for accessible navigation.  Only works if the dir parameter is set and should only go in the head section of a template.</li>
		<li><em>(optional)</em> <tt>href</tt> - If href is used only the href value is generated (no other parameters possible). <strong>Example:</strong> <a href="{cms_selflink href="alias"}"><img src=&quot;&quot;></a></li>
		<li><em>(optional)</em> <tt>image</tt> - A url of an image to use in the link. <strong>Example:</strong> {cms_selflink dir=&quot;next&quot; image=&quot;next.png&quot; text=&quot;Next&quot;}</li>
		<li><em>(optional)</em> <tt>alt</tt> - Alternative text to be used with image (alt=&quot;&quot; will be used if no alt parameter is given).</li>
		<li><em>(optional)</em> <tt>imageonly</tt> - If using an image, whether to suppress display of text links. If you want no text in the link at all, also set lang=0 to suppress the label. <strong>Example:</strong> {cms_selflink dir=&quot;next&quot; image=&quot;next.png&quot; text=&quot;Next&quot; imageonly=1}</li>
		<li><em>(optional)</em> <tt>ext</tt> - For external links, will add class=&quot;external and info text. <strong>warning:</strong> only text, target and title parameters are compatible with this parameter</li>
		<li><em>(optional)</em> <tt>ext_info</tt> - Used together with &quot;ext&quot; defaults to (external link).</li>
        <li><em>(optional)</em> <tt>assign</tt> - Assign the results to the named smarty variable.</li>
		</ul>';
$lang['admin']['about_function_cms_module'] = '	<p>Author: Ted Kulp<tedkulp@users.sf.net></p>
	<p>Version: 1.0</p>
	<p>
	Change History:<br/>
	None
	</p>';
$lang['admin']['help_function_cms_module'] = '	<h3>What does this do?</h3>
	<p>This tag is used to insert modules into your templates and pages. If a module is created to be used as a tag plugin (check it&#039;s help for details), then you should be able to insert it with this tag.</p>
	<h3>How do I use it?</h3>
	<p>It&#039;s just a basic tag plugin.  You would insert it into your template or page like so: <code>{cms_module module=&quot;somemodulename&quot;}</code></p>
	<h3>What parameters does it take?</h3>
	<p>There is only one required parameter.  All other parameters are passed on to the module.</p>
	<ul>
		<li>module - Name of the module to insert.  This is not case sensitive.</li>
	</ul>';
$lang['admin']['about_function_breadcrumbs'] = '<p>Author: Marcus Deglos <<a href="mailto:md@zioncore.com">md@zioncore.com</a>></p>
<p>Version: 1.7</p>
<p>
Change History:<br/>
1.1 - Modified to use new content rewrite (wishy)<br />
1.2 - Added parameters: delimiter, initial, and root (arl)<br />
1.3 - Added parameter: classid (tdh / perl4ever)<br />
1.4 - Added parameter currentclassid and fixed some bugs (arl)<br />
1.5 - Modified to use new hierarchy manager<br />
1.6 - Modified to skip any parents that are marked to be &quot;not shown in menu&quot; except for root<br />
1.7 - Added root_url parameter (elijahlofgren)<br />
</p>';
$lang['admin']['help_function_breadcrumbs'] = '<h3>What does this do?</h3>
<p>Prints a breadcrumb trail .</p>
<h3>How do I use it?</h3>
<p>Just insert the tag into your template/page like: <code>{breadcrumbs}</code></p>
<h3>What parameters does it take?</h3>
<ul>
<li><em>(optional)</em> <tt>delimiter</tt> - Text to seperate entries in the list (default &quot;>>&quot;).</li>
<li><em>(optional)</em> <tt>initial</tt> - 1/0 If set to 1 start the breadcrumbs with a delimiter (default 0).</li>
<li><em>(optional)</em> <tt>root</tt> - Page alias of a page you want to always appear as the first page in
    the list. Can be used to make a page (e.g. the front page) appear to be the root of everything even though it is not.</li>
<li><em>(optional)</em> <tt>root_url</tt> - Override the URL of the root page. Useful for making link be to &#039;/&#039; instead of &#039;/home/&#039;. This requires that the root page be set as the default page.</li>
<li><em>(optional)</em> <tt>classid</tt> - The CSS class for the non current page names, i.e. the first n-1 pages in the list. If the name is a link it is added to the <a href> tags, otherwise it is added to the <span> tags.</li>
<li><em>(optional)</em> <tt>currentclassid</tt> - The CSS class for the <span> tag surrounding the current page name.</li>
<li><em>(optional)</em> <tt>starttext</tt> - Text to append to the front of the breadcrumbs list, something like &quot;You are here&quot;.</li>
</ul>';
$lang['admin']['about_function_anchor'] = '	<p>Author: Ted Kulp<tedkulp@users.sf.net></p>
	<p>Version: 1.1</p>
	<p>
	Change History:<br/>
	<strong>Update to version 1.1 from 1.0</strong> <em>2006/07/19</em><br/>
	Russ added the means to insert a title, a tabindex and a class for the anchor link. Westis added accesskey and changed parameter names to not include &#039;anchorlink&#039;.<br/>
	</hr>
	</p>';
$lang['admin']['help_function_anchor'] = '	<h3>What does this do?</h3>
	<p>Makes a proper anchor link.</p>
	<h3>How do I use it?</h3>
	<p>Just insert the tag into your template/page like: <code>{anchor anchor=&#039;here&#039; text=&#039;Scroll Down&#039;}</code></p>
	<h3>What parameters does it take?</h3>
	<ul>
	<li><tt>anchor</tt> - Where we are linking to.  The part after the #.</li>
	<li><tt>text</tt> - The text to display in the link.</li>
	<li><tt>class</tt> - The class for the link, if any</li>
	<li><tt>title</tt> - The title to display for the link, if any.</li>
	<li><tt>tabindex</tt> - The numeric tabindex for the link, if any.</li>
	<li><tt>accesskey</tt> - The accesskey for the link, if any.</li>
	<li><em>(optional)</em> <tt>onlyhref</tt> - Only display the href and not the entire link. No other options will work</li>
	</ul>';
$lang['admin']['help_function_site_mapper'] = '<h3>What does this do?</h3>
  <p>This is actually just a wrapper tag for the Menu Manager module to make the tag syntax easier, and to simplify creating a sitemap.</p>
<h3>How do I use it?</h3>
  <p>Just put <code>{site_mapper}</code> on a page or in a template. For help about the Menu Manager module, what parameters it takes etc., please refer to the Menu Manager module help.</p>
  <p>By default, if no template option is specified the minimal_menu.tpl file will be used.</p>
  <p>Any parameters used in the tag are available in the menumanager template as <code>{$menuparams.paramname}</code></p>';
$lang['admin']['help_function_redirect_url'] = '<h3>What does this do?</h3>
  <p>This plugin allows you to easily redirect to a specified url.  It is handy inside of smarty conditional logic (for example, redirect to a splash page if the site is not live yet).</p>
<h3>How do I use it?</h3>
<p>Simply insert this tage into your page or template: <code>{redirect_url to=&#039;www.cmsmadesimple.org&#039;}</code></p>';
$lang['admin']['help_function_redirect_page'] = '<h3>What does this do?</h3>
 <p>This plugin allows you to easily redirect to another page.  It is handy inside of smarty conditional logic (for example, redirect to a login page if the user is not logged in.)</p>
<h3>How do I use it?</h3>
<p>Simply insert this tage into your page or template: <code>{redirect_page page=&#039;some-page-alias&#039;}</code></p>';
$lang['admin']['help_function_cms_jquery'] = '<h3>What does this do?</h3>
 <p>This plugin allows you output the javascript liberies and plugins used from the admin.</p>
<h3>How do I use it?</h3>
<p>Simply insert this tage into your page or template: <code>{cms_jquery}</code></p>

<h3>Sample</h3>
<pre><code>{cms_jquery cdn=true exclude=&#039;jquery.ui.nestedSortable-1.3.4.js&#039; append=&#039;uploads/NCleanBlue/js/ie6fix.js&#039;}</code></pre>
<h4><em>Outputs</em></h4>
<pre><code><script type=&quot;text/javascript&quot; src=&quot;https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js&quot;></script>
<script type=&quot;text/javascript&quot; src=&quot;https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js&quot;></script>
<script type=&quot;text/javascript&quot; src=&quot;http://localhost/1.10.x/lib/jquery/js/jquery.json-2.2.js&quot;></script>
<script type=&quot;text/javascript&quot; src=&quot;uploads/NCleanBlue/js/ie6fix.js&quot;></script>
</code></pre>

<h3><em>Included Defaults</em></h3>
<ul>
	<li><tt>jQuery</tt><em>(1.6.2)</em> - jquery-1.6.2.min.js</li>
	<li><tt>jQuery UI</tt><em>(1.8.14)</em> - jquery-ui-1.8.14.custom.min.js</li>
	<li><tt>nestedSortable</tt>(1.3.4) - jquery.ui.nestedSortable-1.3.4.js</li>
	<li><tt>jQuery json</tt><em>(2.2)</em> - jquery/js/jquery.json-2.2.js</li>
</ul>
    
<h3>What parameters does it take?</h3>
<ul>
	<li><em>(optional) </em><tt>exclude</tt> - use comma seperated value(CSV) list of scripts you would like to exclude. <code>&#039;jquery.ui.nestedSortable.js,jquery.json-2.2.js&#039;</code></li>
	<li><em>(optional) </em><tt>append</tt> - use comma seperated value(CSV) list of script paths you would like to append. <code>&#039;/uploade/jquery.ui.nestedSortable.js,http://code.jquery.com/jquery-1.6.2.min.js&#039;</code></li>
	<li><em>(optional) </em><tt>cdn</tt> - use to save the output in a smarty assignment.</li>
	<li><em>(optional) </em><tt>ssl</tt> - use to use the ssl_url as the base path.</li>
	<li><em>(optional) </em><tt>custom_root</tt> - use to set any base path wished.<code>custom_root=&#039;http://test.domain.com/&#039;</code> <br/>NOTE: over writes ssl option and works with the cdn option</li>
	<li><em>(optional)</em> <tt>assign</tt> - Assign the results to the named smarty variable.</li>
	</ul>

';
$lang['admin']['of'] = 'of';
$lang['admin']['first'] = 'اول';
$lang['admin']['last'] = 'آخر';
$lang['admin']['adminspecialgroup'] = 'Warning: Members of this group automatically have all permissions';
$lang['admin']['disablesafemodewarning'] = 'Disable admin safe mode warning';
$lang['admin']['date_format_string'] = 'Date Format String';
$lang['admin']['date_format_string_help'] = '<em>strftime</em> formatted date format string.  Try googling &#039;strftime&#039;';
$lang['admin']['last_modified_at'] = 'Last modified at';
$lang['admin']['last_modified_by'] = 'Last modified by';
$lang['admin']['read'] = 'Read';
$lang['admin']['write'] = 'Write';
$lang['admin']['execute'] = 'Execute';
$lang['admin']['group'] = 'گروه';
$lang['admin']['other'] = 'Other';
$lang['admin']['event_desc_moduleupgraded'] = 'Sent after a module is upgraded';
$lang['admin']['event_help_moduleupgraded'] = '<p>Sent after a module is upgraded.</p>';
$lang['admin']['event_desc_moduleinstalled'] = 'Sent after a module is installed';
$lang['admin']['event_help_moduleinstalled'] = '<p>Sent after a module is installed.</p>';
$lang['admin']['event_desc_moduleuninstalled'] = 'Sent after a module is uninstalled';
$lang['admin']['event_help_moduleuninstalled'] = '<p>Sent after a module is uninstalled.</p>';
$lang['admin']['event_desc_edituserdefinedtagpost'] = 'Sent after a user defined tag is updated';
$lang['admin']['event_help_edituserdefinedtagpost'] = '<p>Sent after a user defined tag is updated.</p>';
$lang['admin']['event_desc_edituserdefinedtagpre'] = 'Sent prior to a user defined tag update';
$lang['admin']['event_help_edituserdefinedtagpre'] = '<p>Sent prior to a user defined tag update.</p>';
$lang['admin']['event_desc_deleteuserdefinedtagpre'] = 'Sent prior to deleting a user defined tag';
$lang['admin']['event_help_deleteuserdefinedtagpre'] = '<p>Sent prior to deleting a user defined tag.</p>';
$lang['admin']['event_desc_deleteuserdefinedtagpost'] = 'Sent after a user defined tag is deleted';
$lang['admin']['event_help_deleteuserdefinedtagpost'] = '<p>Sent after a user defined tag is deleted.</p>';
$lang['admin']['event_desc_adduserdefinedtagpost'] = 'Sent after a user defined tag is inserted';
$lang['admin']['event_help_adduserdefinedtagpre'] = '<p>Sent after a user defined tag is inserted.</p>';
$lang['admin']['event_desc_adduserdefinedtagpre'] = 'Sent prior to a user defined tag insert';
$lang['admin']['event_help_adduserdefinedtagpost'] = '<p>Sent prior to a user defined tag insert.</p>';
$lang['admin']['global_umask'] = 'File Creation Mask (umask)';
$lang['admin']['errorcantcreatefile'] = 'Could not create a file (permissions problem?)';
$lang['admin']['errormoduleversionincompatible'] = 'Module is incompatible with this version of CMS';
$lang['admin']['errormodulenotloaded'] = 'Internal error, the module has not been instantiated';
$lang['admin']['errormodulenotfound'] = 'Internal error, could not find the instance of a module';
$lang['admin']['errorinstallfailed'] = 'Module installation failed';
$lang['admin']['errormodulewontload'] = 'Problem instantiating an available module';
$lang['admin']['frontendlang'] = 'Default language for the frontend';
$lang['admin']['info_edituser_password'] = 'Change this field to change the user&#039;s password';
$lang['admin']['info_edituser_passwordagain'] = 'Change this field to change the user&#039;s password';
$lang['admin']['originator'] = 'Originator';
$lang['admin']['module_name'] = 'Module Name';
$lang['admin']['event_name'] = 'Event Name';
$lang['admin']['event_description'] = 'Event Description';
$lang['admin']['error_delete_default_parent'] = 'You cannot delete the parent of the default page.';
$lang['admin']['jsdisabled'] = 'Sorry, this function requires that you have Javascript enabled.';
$lang['admin']['order'] = 'Order';
$lang['admin']['reorderpages'] = 'Reorder Pages';
$lang['admin']['reorder'] = 'Reorder';
$lang['admin']['page_reordered'] = 'Page was successfully reordered.';
$lang['admin']['pages_reordered'] = 'Pages were successfully reordered';
$lang['admin']['sibling_duplicate_order'] = 'Two sibling pages can not have the same order. Pages were not reordered.';
$lang['admin']['no_orders_changed'] = 'You chose to reorder pages, but you did not change the order of any of them. Pages were not reordered.';
$lang['admin']['order_too_small'] = 'A page order cannot be zero. Pages were not reordered.';
$lang['admin']['order_too_large'] = 'A page order cannot be larger than the number of pages in that level. Pages were not reordered.';
$lang['admin']['user_tag'] = 'User Tag';
$lang['admin']['add'] = 'Add';
$lang['admin']['CSS'] = 'CSS';
$lang['admin']['about'] = 'About';
$lang['admin']['action'] = 'Action';
$lang['admin']['actionstatus'] = 'Action/Status';
$lang['admin']['active'] = 'Active';
$lang['admin']['addcontent'] = 'Add New Content';
$lang['admin']['cantremove'] = 'Cannot Remove';
$lang['admin']['changepermissions'] = 'Change Permissions';
$lang['admin']['changepermissionsconfirm'] = 'USE CAUTION\n\nThis action will attempt to ensure that all of the files making up the module are writable by the web server.\nAre you sure you want to continue?';
$lang['admin']['contentadded'] = 'The content was successfully added to the database.';
$lang['admin']['contentupdated'] = 'The content was successfully updated.';
$lang['admin']['contentdeleted'] = 'The content was successfully removed from the database.';
$lang['admin']['success'] = 'Success';
$lang['admin']['addcss'] = 'Add a Stylesheet';
$lang['admin']['addgroup'] = 'Add New Group';
$lang['admin']['additionaleditors'] = 'Additional Editors';
$lang['admin']['addtemplate'] = 'Add New Template';
$lang['admin']['adduser'] = 'Add New User';
$lang['admin']['addusertag'] = 'Add User Defined Tag';
$lang['admin']['adminaccess'] = 'Access to login to admin';
$lang['admin']['adminlog'] = 'Admin Log';
$lang['admin']['adminlogcleared'] = 'The Admin Log was succesfully cleared';
$lang['admin']['adminlogempty'] = 'The Admin Log is empty';
$lang['admin']['adminsystemtitle'] = 'CMS Admin System';
$lang['admin']['adminpaneltitle'] = 'CMS Made Simple Admin Console';
$lang['admin']['advanced'] = 'Advanced';
$lang['admin']['aliasalreadyused'] = 'The supplied &quot;Page Alias&quot; is already in use on another page.  Change the &quot;Page Alias&quot; to something else.';
$lang['admin']['aliasmustbelettersandnumbers'] = 'Alias must be all letters and numbers';
$lang['admin']['aliasnotaninteger'] = 'Alias cannot be an integer';
$lang['admin']['allpagesmodified'] = 'All pages modified!';
$lang['admin']['assignments'] = 'Assign Users';
$lang['admin']['associationexists'] = 'This association already exists';
$lang['admin']['autoinstallupgrade'] = 'Automatically install or upgrade';
$lang['admin']['back'] = 'Back to Menu';
$lang['admin']['backtoplugins'] = 'Back to Plugins List';
$lang['admin']['cancel'] = 'انصراف';
$lang['admin']['cantchmodfiles'] = 'Couldn&#039;t change permissions on some files';
$lang['admin']['cantremovefiles'] = 'Problem Removing Files (permissions?)';
$lang['admin']['confirmcancel'] = 'Are you sure you want to discard your changes? Click OK to discard all changes. Click Cancel to continue editing.';
$lang['admin']['canceldescription'] = 'Discard Changes';
$lang['admin']['clearadminlog'] = 'Clear Admin Log';
$lang['admin']['code'] = 'Code';
$lang['admin']['confirmdefault'] = 'Are you sure you want to set - %s - as site default page?';
$lang['admin']['confirmdeletedir'] = 'Are you sure you want to delete this dir and all of its contents?';
$lang['admin']['content'] = 'Content';
$lang['admin']['contentmanagement'] = 'Content Management';
$lang['admin']['contenttype'] = 'Content Type';
$lang['admin']['copy'] = 'کپی';
$lang['admin']['copytemplate'] = 'Copy Template';
$lang['admin']['create'] = 'Create';
$lang['admin']['createnewfolder'] = 'Create New Folder';
$lang['admin']['cssalreadyused'] = 'CSS name already in use';
$lang['admin']['cssmanagement'] = 'CSS Management';
$lang['admin']['currentassociations'] = 'Current Associations';
$lang['admin']['currentdirectory'] = 'Current Directory';
$lang['admin']['currentgroups'] = 'Current Groups';
$lang['admin']['currentpages'] = 'Current Pages';
$lang['admin']['currenttemplates'] = 'Current Templates';
$lang['admin']['currentusers'] = 'Current Users';
$lang['admin']['custom404'] = 'Custom 404 Error Message';
$lang['admin']['database'] = 'Database';
$lang['admin']['databaseprefix'] = 'Database Prefix';
$lang['admin']['databasetype'] = 'Database Type';
$lang['admin']['date'] = 'تاریخ';
$lang['admin']['default'] = 'پیشفرض';
$lang['admin']['delete'] = 'حذف';
$lang['admin']['deleteconfirm'] = 'Are you sure you want to delete - %s - ?';
$lang['admin']['deleteassociationconfirm'] = 'Are you sure you want to delete association to - %s - ?';
$lang['admin']['deletecss'] = 'Delete CSS';
$lang['admin']['dependencies'] = 'Dependencies';
$lang['admin']['description'] = 'Description';
$lang['admin']['directoryexists'] = 'This directory already exists.';
$lang['admin']['down'] = 'پایین';
$lang['admin']['edit'] = 'ویرایش';
$lang['admin']['editconfiguration'] = 'ویرایش پیکربندی';
$lang['admin']['editcontent'] = 'ویرایش محتوا';
$lang['admin']['editcss'] = 'Edit Stylesheet';
$lang['admin']['editcsssuccess'] = 'Stylesheet updated';
$lang['admin']['editgroup'] = 'ویرایش گروه';
$lang['admin']['editpage'] = 'ویرایش صفحه';
$lang['admin']['edittemplate'] = 'ویرایش قالب';
$lang['admin']['edittemplatesuccess'] = 'Template updated';
$lang['admin']['edituser'] = 'ویرایش کاربر';
$lang['admin']['editusertag'] = 'Edit User Defined Tag';
$lang['admin']['usertagadded'] = 'The User Defined Tag was successfully added.';
$lang['admin']['usertagupdated'] = 'The User Defined Tag was successfully updated.';
$lang['admin']['usertagdeleted'] = 'The User Defined Tag was successfully removed.';
$lang['admin']['email'] = 'Email Address';
$lang['admin']['errorattempteddowngrade'] = 'Installing this module would result in a downgrade.  Operation aborted';
$lang['admin']['errorchildcontent'] = 'Content still contains child contents. Please remove them first.';
$lang['admin']['errorcopyingtemplate'] = 'Error Copying Template';
$lang['admin']['errorcouldnotparsexml'] = 'Error parsing XML file. Please make sure you are uploading a .xml file and not a .tar.gz or zip file.';
$lang['admin']['errorcreatingassociation'] = 'Error creating association';
$lang['admin']['errorcssinuse'] = 'This Stylesheet is still used by template or pages. Please remove those associations first.';
$lang['admin']['errordefaultpage'] = 'Can not delete the current default page. Please set a different one first.';
$lang['admin']['errordeletingassociation'] = 'Error deleting association';
$lang['admin']['errordeletingcss'] = 'Error deleteing css';
$lang['admin']['errordeletingdirectory'] = 'Could not delete directory. Permissions problem?';
$lang['admin']['errordeletingfile'] = 'Could not delete file. Permissions Problem?';
$lang['admin']['errordirectorynotwritable'] = 'No permission to write in directory.  This could be caused by file permissions and ownership.  Safe mode may also be in effect.';
$lang['admin']['errordtdmismatch'] = 'DTD Version missing or incompatible in the XML file';
$lang['admin']['errorgettingcssname'] = 'Error getting Stylesheet name';
$lang['admin']['errorgettingtemplatename'] = 'Error getting template name';
$lang['admin']['errorincompletexml'] = 'XML File is incomplete or invalid';
$lang['admin']['uploadxmlfile'] = 'Install module via XML file';
$lang['admin']['cachenotwritable'] = 'Cache folder is not writable. Clearing cache will not work. Please make the tmp/cache folder have full read/write/execute permissions (chmod 777).  You may also have to disable safe mode.';
$lang['admin']['error_nomodules'] = 'No modules installed! Check Extentions > Modules';
$lang['admin']['modulesnotwritable'] = 'The modules folder <em>(and/or the uploads folder)</em> is not writable, if you would like to install modules by uploading an XML file you need ensure that these folders have full read/write/execute permissions (chmod 777).  Safe mode may also be in effect.';
$lang['admin']['noxmlfileuploaded'] = 'No file was uploaded. To install a module via XML you must choose and upload an module .xml file from your computer.';
$lang['admin']['errorinsertingcss'] = 'Error inserting Stylesheet';
$lang['admin']['errorinsertinggroup'] = 'Error inserting group';
$lang['admin']['errorinsertingtag'] = 'Error inserting user tag';
$lang['admin']['errorinsertingtemplate'] = 'Error inserting template';
$lang['admin']['errorinsertinguser'] = 'Error inserting user';
$lang['admin']['errornofilesexported'] = 'Error exporting files to xml';
$lang['admin']['errorretrievingcss'] = 'Error retrieving Stylesheet';
$lang['admin']['errorretrievingtemplate'] = 'Error retrieving template';
$lang['admin']['errortemplateinuse'] = 'This template is still in use by a page. Please remove it first.';
$lang['admin']['errorupdatingcss'] = 'Error updating Stylesheet';
$lang['admin']['errorupdatinggroup'] = 'Error updating group';
$lang['admin']['errorupdatingpages'] = 'Error updating pages';
$lang['admin']['errorupdatingtemplate'] = 'Error updating template';
$lang['admin']['errorupdatinguser'] = 'Error updating user';
$lang['admin']['errorupdatingusertag'] = 'Error updating user tag';
$lang['admin']['erroruserinuse'] = 'This user still owns content pages. Please change ownership to another user before deleting.';
$lang['admin']['eventhandlers'] = 'Event Manager';
$lang['admin']['eventhandler'] = 'Event Handlers';
$lang['admin']['editeventhandler'] = 'Edit Event Handler';
$lang['admin']['eventhandlerdescription'] = 'Associate user tags with events';
$lang['admin']['export'] = 'Export';
$lang['admin']['event'] = 'Event';
$lang['admin']['false'] = 'False';
$lang['admin']['settrue'] = 'Set True';
$lang['admin']['filecreatedirnodoubledot'] = 'Directory cannot contain &#039;..&#039;.';
$lang['admin']['filecreatedirnoname'] = 'Cannot create a directory with no name.';
$lang['admin']['filecreatedirnoslash'] = 'Directory cannot contain &#039;/&#039; or &#039;\&#039;.';
$lang['admin']['filemanagement'] = 'File Management';
$lang['admin']['filename'] = 'Filename';
$lang['admin']['filenotuploaded'] = 'File could not be uploaded. This could be a permissions or Safe mode problem?';
$lang['admin']['filesize'] = 'File Size';
$lang['admin']['firstname'] = 'First Name';
$lang['admin']['groupmanagement'] = 'Group Management';
$lang['admin']['grouppermissions'] = 'Group Permissions';
$lang['admin']['handler'] = 'Handler (user defined tag)';
$lang['admin']['headtags'] = 'Head Tags';
$lang['admin']['help'] = 'راهنمایی';
$lang['admin']['new_window'] = 'new window';
$lang['admin']['helpwithsection'] = '%s Help';
$lang['admin']['helpaddtemplate'] = '<p>A template is what controls the look and feel of your site&#039;s content.</p><p>Create the layout here and also add your CSS in the Stylesheet section to control the look of your various elements.</p>';
$lang['admin']['helplisttemplate'] = '<p>This page allows you to edit, delete, and create templates.</p><p>To create a new template, click on the <u>Add New Template</u> button.</p><p>If you wish to set all content pages to use the same template, click on the <u>Set All Content</u> link.</p><p>If you wish to duplicate a template, click on the <u>Copy</u> icon and you will be prompted to name the new duplicate template.</p>';
$lang['admin']['home'] = 'خانه';
$lang['admin']['homepage'] = 'Homepage';
$lang['admin']['hostname'] = 'Hostname';
$lang['admin']['idnotvalid'] = 'The given id is not valid';
$lang['admin']['imagemanagement'] = 'Image Manager';
$lang['admin']['informationmissing'] = 'Information missing';
$lang['admin']['install'] = 'نصب';
$lang['admin']['invalidcode'] = 'Invalid code entered.';
$lang['admin']['illegalcharacters'] = 'Invalid characters in field %s.';
$lang['admin']['invalidcode_brace_missing'] = 'Uneven amount of braces';
$lang['admin']['invalidtemplate'] = 'The template is not valid';
$lang['admin']['itemid'] = 'Item ID';
$lang['admin']['itemname'] = 'Item Name';
$lang['admin']['language'] = 'زبان';
$lang['admin']['lastname'] = 'Last Name';
$lang['admin']['logout'] = 'Logout';
$lang['admin']['loginprompt'] = 'Enter a valid user credential to get access to the Admin Console.';
$lang['admin']['logintitle'] = 'Login to CMS Made Simple';
$lang['admin']['menutext'] = 'Menu Text';
$lang['admin']['missingparams'] = 'Some parameters were missing or invalid';
$lang['admin']['modifygroupassignments'] = 'Modify Group Assignments';
$lang['admin']['moduleabout'] = 'About the %s module';
$lang['admin']['modulehelp'] = 'Help for the %s module';
$lang['admin']['msg_defaultcontent'] = 'Add code here that should appear as the default content of all new pages';
$lang['admin']['msg_defaultmetadata'] = 'Add code here that should appear in the metadata section of all new pages';
$lang['admin']['wikihelp'] = 'Community Help';
$lang['admin']['moduleinstalled'] = 'Module already installed';
$lang['admin']['moduleinterface'] = '%s Interface';
$lang['admin']['modules'] = 'Modules';
$lang['admin']['move'] = 'انتقال';
$lang['admin']['name'] = 'نام';
$lang['admin']['needpermissionto'] = 'You need the &#039;%s&#039; permission to perform that function.';
$lang['admin']['needupgrade'] = 'Needs Upgrade';
$lang['admin']['newtemplatename'] = 'New Template Name';
$lang['admin']['next'] = 'بعدی';
$lang['admin']['noaccessto'] = 'No Access to %s';
$lang['admin']['nocss'] = 'No Stylesheet';
$lang['admin']['noentries'] = 'No Entries';
$lang['admin']['nofieldgiven'] = 'No %s given!';
$lang['admin']['nofiles'] = 'No Files';
$lang['admin']['nopasswordmatch'] = 'Passwords do not match';
$lang['admin']['norealdirectory'] = 'No real directory given';
$lang['admin']['norealfile'] = 'No real file given';
$lang['admin']['notinstalled'] = 'Not Installed';
$lang['admin']['overwritemodule'] = 'Overwrite existing modules';
$lang['admin']['owner'] = 'Owner';
$lang['admin']['pagealias'] = 'Page Alias';
$lang['admin']['pagedefaults'] = 'Page Defaults';
$lang['admin']['pagedefaultsdescription'] = 'Set default values for new pages';
$lang['admin']['parent'] = 'Parent';
$lang['admin']['password'] = 'رمز عبور';
$lang['admin']['passwordagain'] = 'رمز عبور (دوباره)';
$lang['admin']['permission'] = 'Permission';
$lang['admin']['permissions'] = 'Permissions';
$lang['admin']['permissionschanged'] = 'Permissions have been updated.';
$lang['admin']['pluginabout'] = 'About the %s tag';
$lang['admin']['pluginhelp'] = 'Help for the %s tag';
$lang['admin']['pluginmanagement'] = 'Plugin Management';
$lang['admin']['prefsupdated'] = 'Preferences have been updated.';
$lang['admin']['preview'] = 'پیشنمایش';
$lang['admin']['previewdescription'] = 'پیشنمایش تغییرات';
$lang['admin']['previous'] = 'قبلی';
$lang['admin']['remove'] = 'حذف';
$lang['admin']['removeconfirm'] = 'This action will permanently remove the files making up this module from this installation.\nAre you sure you want to proceed?';
$lang['admin']['removecssassociation'] = 'Remove Stylesheet Assocation';
$lang['admin']['saveconfig'] = 'Save Config';
$lang['admin']['send'] = 'ارسال';
$lang['admin']['setallcontent'] = 'Set All Pages';
$lang['admin']['setallcontentconfirm'] = 'Are you sure you want to set all pages to use this template?';
$lang['admin']['showinmenu'] = 'Show in Menu';
$lang['admin']['use_name'] = 'In the parent page dropdown, show the page title instead of the menu text';
$lang['admin']['showsite'] = 'نمایش سایت';
$lang['admin']['sitedownmessage'] = 'Site Down Message';
$lang['admin']['siteprefs'] = 'Global Settings';
$lang['admin']['status'] = 'Status';
$lang['admin']['stylesheet'] = 'Stylesheet';
$lang['admin']['submit'] = 'Submit';
$lang['admin']['submitdescription'] = 'ذخیره تنظیمات';
$lang['admin']['tags'] = 'Tags';
$lang['admin']['template'] = 'Template';
$lang['admin']['templateexists'] = 'Template name already exists';
$lang['admin']['templatemanagement'] = 'Template Management';
$lang['admin']['title'] = 'عنوان';
$lang['admin']['tools'] = 'Tools';
$lang['admin']['true'] = 'True';
$lang['admin']['setfalse'] = 'Set False';
$lang['admin']['type'] = 'Type';
$lang['admin']['typenotvalid'] = 'Type is not valid';
$lang['admin']['uninstall'] = 'Uninstall';
$lang['admin']['uninstallconfirm'] = 'Are you sure you want to uninstall this module? Name:';
$lang['admin']['up'] = 'بالا';
$lang['admin']['upgrade'] = 'Upgrade';
$lang['admin']['upgradeconfirm'] = 'Are you sure you want to upgrade this?';
$lang['admin']['uploadfile'] = 'Upload File';
$lang['admin']['url'] = 'URL';
$lang['admin']['useadvancedcss'] = 'Use Advanced Stylesheet Management';
$lang['admin']['user'] = 'User';
$lang['admin']['userdefinedtags'] = 'User Defined Tags';
$lang['admin']['usermanagement'] = 'User Management';
$lang['admin']['username'] = 'نام کاربری';
$lang['admin']['usernameincorrect'] = 'Username or password incorrect';
$lang['admin']['userprefs'] = 'User Preferences';
$lang['admin']['usersassignedtogroup'] = 'Users Assigned to Group %s';
$lang['admin']['usertagexists'] = 'A tag with this name already exists. Please choose another.';
$lang['admin']['usewysiwyg'] = 'Use WYSIWYG editor for content';
$lang['admin']['version'] = 'Version';
$lang['admin']['view'] = 'View';
$lang['admin']['welcomemsg'] = 'Welcome %s';
$lang['admin']['directoryabove'] = 'directory above current level';
$lang['admin']['nodefault'] = 'No Default Selected';
$lang['admin']['blobexists'] = 'Global Content Block name already exists';
$lang['admin']['blobmanagement'] = 'Global Content Block Management';
$lang['admin']['errorinsertingblob'] = 'There was an error inserting the Global Content Block';
$lang['admin']['addhtmlblob'] = 'Add Global Content Block';
$lang['admin']['edithtmlblob'] = 'Edit Global Content Block';
$lang['admin']['edithtmlblobsuccess'] = 'Global content block updated';
$lang['admin']['tagtousegcb'] = 'Tag to Use this Block';
$lang['admin']['gcb_wysiwyg'] = 'Enable GCB WYSIWYG';
$lang['admin']['gcb_wysiwyg_help'] = 'Enable the WYSIWYG editor while editing Global Content Blocks';
$lang['admin']['filemanager'] = 'File Manager';
$lang['admin']['imagemanager'] = 'Image Manager';
$lang['admin']['encoding'] = 'Encoding';
$lang['admin']['clearcache'] = 'Clear Cache';
$lang['admin']['clear'] = 'Clear';
$lang['admin']['cachecleared'] = 'Cache Cleared';
$lang['admin']['apply'] = 'اعمال';
$lang['admin']['applydescription'] = 'Save changes and continue to edit';
$lang['admin']['none'] = 'none';
$lang['admin']['wysiwygtouse'] = 'Select WYSIWYG to use';
$lang['admin']['syntaxhighlightertouse'] = 'Select syntax highlighter to use';
$lang['admin']['hasdependents'] = 'Has Dependents';
$lang['admin']['missingdependency'] = 'Missing Dependency';
$lang['admin']['minimumversion'] = 'Minimum Version';
$lang['admin']['minimumversionrequired'] = 'Minimum CMSMS Version Required';
$lang['admin']['maximumversion'] = 'Maximum Version';
$lang['admin']['maximumversionsupported'] = 'Maximum CMSMS Version Supported';
$lang['admin']['depsformodule'] = 'Dependencies for %s Module';
$lang['admin']['installed'] = 'Installed';
$lang['admin']['author'] = 'Author';
$lang['admin']['changehistory'] = 'Change History';
$lang['admin']['moduleerrormessage'] = 'Error Message for %s Module';
$lang['admin']['moduleupgradeerror'] = 'There was an error upgrading the module.';
$lang['admin']['moduleinstallmessage'] = 'Install Message for %s Module';
$lang['admin']['moduleuninstallmessage'] = 'Uninstall Message for %s Module';
$lang['admin']['admintheme'] = 'Administration Theme';
$lang['admin']['addstylesheet'] = 'Add a Stylesheet';
$lang['admin']['editstylesheet'] = 'Edit Stylesheet';
$lang['admin']['addcssassociation'] = 'Add Stylesheet Association';
$lang['admin']['attachstylesheet'] = 'Attach This Stylesheet';
$lang['admin']['attachtemplate'] = 'Attach to this Template';
$lang['admin']['main'] = 'Main';
$lang['admin']['pages'] = 'Pages';
$lang['admin']['page'] = 'Page';
$lang['admin']['files'] = 'Files';
$lang['admin']['layout'] = 'Layout';
$lang['admin']['usersgroups'] = 'Users &amp; Groups';
$lang['admin']['extensions'] = 'Extensions';
$lang['admin']['preferences'] = 'Preferences';
$lang['admin']['admin'] = 'Site Admin';
$lang['admin']['viewsite'] = 'View Site';
$lang['admin']['templatecss'] = 'Assign Templates to Stylesheet';
$lang['admin']['plugins'] = 'Plugins';
$lang['admin']['movecontent'] = 'Move Pages';
$lang['admin']['module'] = 'Module';
$lang['admin']['usertags'] = 'User Defined Tags';
$lang['admin']['htmlblobs'] = 'Global Content Blocks';
$lang['admin']['adminhome'] = 'Administration Home';
$lang['admin']['liststylesheets'] = 'Style Sheets';
$lang['admin']['preferencesdescription'] = 'This is where you set various site-wide preferences.';
$lang['admin']['adminlogdescription'] = 'Shows a log of who did what in the admin.';
$lang['admin']['mainmenu'] = 'Main Menu';
$lang['admin']['users'] = 'Users';
$lang['admin']['usersdescription'] = 'This is where you manage users.';
$lang['admin']['groups'] = 'Groups';
$lang['admin']['groupsdescription'] = 'This is where you manage groups.';
$lang['admin']['groupassignments'] = 'Group Assignments';
$lang['admin']['groupassignmentdescription'] = 'Here you can assign users to groups.';
$lang['admin']['groupperms'] = 'Group Permissions';
$lang['admin']['grouppermsdescription'] = 'Set permissions and access levels for groups';
$lang['admin']['pagesdescription'] = 'This is where we add and edit pages and other content.';
$lang['admin']['htmlblobdescription'] = 'Global Content Blocks are chunks of content you can place in your pages or templates.';
$lang['admin']['templates'] = 'Templates';
$lang['admin']['templatesdescription'] = 'This is where we add and edit templates. Templates define the look and feel of your site.';
$lang['admin']['stylesheets'] = 'Stylesheets';
$lang['admin']['stylesheetsdescription'] = 'Stylesheet management is an advanced way to handle cascading Stylesheets (CSS) separately from templates.';
$lang['admin']['filemanagerdescription'] = 'Upload and manage files.';
$lang['admin']['imagemanagerdescription'] = 'Upload/edit and remove images.';
$lang['admin']['moduledescription'] = 'Modules extend CMS Made Simple to provide all kinds of custom functionality.';
$lang['admin']['tagdescription'] = 'Tags are little bits of functionality that can be added to your content and/or templates.';
$lang['admin']['usertagdescription'] = 'Tags that you can create and modify yourself to perform specific tasks, right from your browser.';
$lang['admin']['installdirwarning'] = '<em><strong>Warning:</strong></em> install directory still exists. Please remove it completely.';
$lang['admin']['subitems'] = 'Subitems';
$lang['admin']['extensionsdescription'] = 'Modules, tags, and other assorted fun.';
$lang['admin']['usersgroupsdescription'] = 'User and Group related items.';
$lang['admin']['layoutdescription'] = 'Site layout options.';
$lang['admin']['admindescription'] = 'Site Administration functions.';
$lang['admin']['contentdescription'] = 'This is where we add and edit content.';
$lang['admin']['enablecustom404'] = 'Enable Custom 404 Message';
$lang['admin']['enablesitedown'] = 'Enable Site Down Message';
$lang['admin']['enablewysiwyg'] = 'Enable WYSIWYG on Site Down Message';
$lang['admin']['bookmarks'] = 'Shortcuts';
$lang['admin']['user_created'] = 'Custom Shortcuts';
$lang['admin']['forums'] = 'Forums';
$lang['admin']['wiki'] = 'Wiki';
$lang['admin']['irc'] = 'IRC';
$lang['admin']['module_help'] = 'Module Help';
$lang['admin']['managebookmarks'] = 'Manage Shortcuts';
$lang['admin']['editbookmark'] = 'Edit Shortcut';
$lang['admin']['addbookmark'] = 'Add Shortcut';
$lang['admin']['recentpages'] = 'Recent Pages';
$lang['admin']['groupname'] = 'Group Name';
$lang['admin']['selectgroup'] = 'Select Group';
$lang['admin']['updateperm'] = 'Update Permissions';
$lang['admin']['admincallout'] = 'Administration Shortcuts';
$lang['admin']['showbookmarks'] = 'Show Admin Shortcuts';
$lang['admin']['hide_help_links'] = 'Hide help links';
$lang['admin']['hide_help_links_help'] = 'Check this box to disable the wiki and module help links in page headers.';
$lang['admin']['showrecent'] = 'Show Recently Used Pages';
$lang['admin']['attachtotemplate'] = 'Attach Stylesheet to Template';
$lang['admin']['attachstylesheets'] = 'Attach Stylesheets';
$lang['admin']['indent'] = 'Indent Pagelist to Emphasize Hierarchy';
$lang['admin']['adminindent'] = 'Content Display';
$lang['admin']['contract'] = 'Collapse Section';
$lang['admin']['expand'] = 'Expand Section';
$lang['admin']['expandall'] = 'Expand All Sections';
$lang['admin']['contractall'] = 'Collapse All Sections';
$lang['admin']['menu_bookmarks'] = '[+]';
$lang['admin']['globalconfig'] = 'Global Settings';
$lang['admin']['adminpaging'] = 'Number of Content Items to show per/page in Page List';
$lang['admin']['nopaging'] = 'Show All Items';
$lang['admin']['myprefs'] = 'My Preferences';
$lang['admin']['myprefsdescription'] = 'This is where you can customize the site admin area to work the way you want.';
$lang['admin']['myaccount'] = 'My Account';
$lang['admin']['myaccountdescription'] = 'This is where you can update your personal account details.';
$lang['admin']['adminprefs'] = 'User Preferences';
$lang['admin']['adminprefsdescription'] = 'This is where you set your specific preferences for site administration.';
$lang['admin']['managebookmarksdescription'] = 'This is where you can manage your administration shortcuts.';
$lang['admin']['options'] = 'Options';
$lang['admin']['langparam'] = 'Parameter is used to specify what language to use for display on the frontend. Not all modules support or need this.';
$lang['admin']['parameters'] = 'Parameters';
$lang['admin']['mediatype'] = 'Media Type';
$lang['admin']['mediatype_'] = 'None set : will affect everywhere ';
$lang['admin']['mediatype_all'] = 'all : Suitable for all devices.';
$lang['admin']['mediatype_aural'] = 'aural : Intended for speech synthesizers.';
$lang['admin']['mediatype_braille'] = 'braille : Intended for braille tactile feedback devices.';
$lang['admin']['mediatype_embossed'] = 'embossed : Intended for paged braille printers.';
$lang['admin']['mediatype_handheld'] = 'handheld : Intended for handheld devices';
$lang['admin']['mediatype_print'] = 'print : Intended for paged, opaque material and for documents viewed on screen in print preview mode.';
$lang['admin']['mediatype_projection'] = 'projection : Intended for projected presentations, for example projectors or print to transparencies.';
$lang['admin']['mediatype_screen'] = 'screen : Intended primarily for color computer screens.';
$lang['admin']['mediatype_tty'] = 'tty : Intended for media using a fixed-pitch character grid, such as teletypes and terminals.';
$lang['admin']['mediatype_tv'] = 'tv : Intended for television-type devices.';
$lang['admin']['assignmentchanged'] = 'Group Assignments have been updated.';
$lang['admin']['stylesheetexists'] = 'Stylesheet Exists';
$lang['admin']['errorcopyingstylesheet'] = 'Error Copying Stylesheet';
$lang['admin']['copystylesheet'] = 'Copy Stylesheet';
$lang['admin']['newstylesheetname'] = 'New Stylesheet Name';
$lang['admin']['target'] = 'Target';
$lang['admin']['xml'] = 'XML';
$lang['admin']['xmlmodulerepository'] = 'URL of ModuleRepository soap server';
$lang['admin']['metadata'] = 'Metadata';
$lang['admin']['globalmetadata'] = 'Global Metadata';
$lang['admin']['titleattribute'] = 'Description (title attribute)';
$lang['admin']['tabindex'] = 'Tab Index';
$lang['admin']['accesskey'] = 'Access Key';
$lang['admin']['sitedownwarning'] = '<strong>Warning:</strong> Your site is currently showing a &quot;Site Down for Maintenence&quot; message. Remove the %s file to resolve this.';
$lang['admin']['deletecontent'] = 'Delete Content';
$lang['admin']['deletepages'] = 'Delete these pages?';
$lang['admin']['selectall'] = 'Select All';
$lang['admin']['selecteditems'] = 'With Selected';
$lang['admin']['inactive'] = 'Inactive';
$lang['admin']['deletetemplates'] = 'Delete Templates';
$lang['admin']['templatestodelete'] = 'These templates will be deleted';
$lang['admin']['wontdeletetemplateinuse'] = 'These templates are in use and will not be deleted';
$lang['admin']['deletetemplate'] = 'Delete Templates';
$lang['admin']['stylesheetstodelete'] = 'These stylesheets will be deleted';
$lang['admin']['sitename'] = 'نام سایت';
$lang['admin']['siteadmin'] = 'Site Admin';
$lang['admin']['images'] = 'Image Manager';
$lang['admin']['blobs'] = 'Global Content Blocks';
$lang['admin']['groupmembers'] = 'Group Assignments';
$lang['admin']['troubleshooting'] = '(Troubleshooting)';
$lang['admin']['event_desc_loginpost'] = 'Sent after a user logs into the admin panel';
$lang['admin']['event_desc_logoutpost'] = 'Sent after a user logs out of the admin panel';
$lang['admin']['event_desc_adduserpre'] = 'Sent before a new user is created';
$lang['admin']['event_desc_adduserpost'] = 'Sent after a new user is created';
$lang['admin']['event_desc_edituserpre'] = 'Sent before edits to a user are saved';
$lang['admin']['event_desc_edituserpost'] = 'Sent after edits to a user are saved';
$lang['admin']['event_desc_deleteuserpre'] = 'Sent before a user is deleted from the system';
$lang['admin']['event_desc_deleteuserpost'] = 'Sent after a user is deleted from the system';
$lang['admin']['event_desc_addgrouppre'] = 'Sent before a new group is created';
$lang['admin']['event_desc_addgrouppost'] = 'Sent after a new group is created';
$lang['admin']['event_desc_changegroupassignpre'] = 'Sent before group assignments are saved';
$lang['admin']['event_desc_changegroupassignpost'] = 'Sent after group assignments are saved';
$lang['admin']['event_desc_editgrouppre'] = 'Sent before edits to a group are saved';
$lang['admin']['event_desc_editgrouppost'] = 'Sent after edits to a group are saved';
$lang['admin']['event_desc_deletegrouppre'] = 'Sent before a group is deleted from the system';
$lang['admin']['event_desc_deletegrouppost'] = 'Sent after a group is deleted from the system';
$lang['admin']['event_desc_addstylesheetpre'] = 'Sent before a new stylesheet is created';
$lang['admin']['event_desc_addstylesheetpost'] = 'Sent after a new stylesheet is created';
$lang['admin']['event_desc_editstylesheetpre'] = 'Sent before edits to a stylesheet are saved';
$lang['admin']['event_desc_editstylesheetpost'] = 'Sent after edits to a stylesheet are saved';
$lang['admin']['event_desc_deletestylesheetpre'] = 'Sent before a stylesheet is deleted from the system';
$lang['admin']['event_desc_deletestylesheetpost'] = 'Sent after a stylesheet is deleted from the system';
$lang['admin']['event_desc_addtemplatepre'] = 'Sent before a new template is created';
$lang['admin']['event_desc_addtemplatepost'] = 'Sent after a new template is created';
$lang['admin']['event_desc_edittemplatepre'] = 'Sent before edits to a template are saved';
$lang['admin']['event_desc_edittemplatepost'] = 'Sent after edits to a template are saved';
$lang['admin']['event_desc_deletetemplatepre'] = 'Sent before a template is deleted from the system';
$lang['admin']['event_desc_deletetemplatepost'] = 'Sent after a template is deleted from the system';
$lang['admin']['event_desc_templateprecompile'] = 'Sent before a template is sent to smarty for processing';
$lang['admin']['event_desc_templatepostcompile'] = 'Sent after a template has been processed by smarty';
$lang['admin']['event_desc_addglobalcontentpre'] = 'Sent before a new global content block is created';
$lang['admin']['event_desc_addglobalcontentpost'] = 'Sent after a new global content block is created';
$lang['admin']['event_desc_editglobalcontentpre'] = 'Sent before edits to a global content block are saved';
$lang['admin']['event_desc_editglobalcontentpost'] = 'Sent after edits to a global content block are saved';
$lang['admin']['event_desc_deleteglobalcontentpre'] = 'Sent before a global content block is deleted from the system';
$lang['admin']['event_desc_deleteglobalcontentpost'] = 'Sent after a global content block is deleted from the system';
$lang['admin']['event_desc_globalcontentprecompile'] = 'Sent before a global content block is sent to smarty for processing';
$lang['admin']['event_desc_globalcontentpostcompile'] = 'Sent after a global content block has been processed by smarty';
$lang['admin']['event_desc_contenteditpre'] = 'Sent before edits to content are saved';
$lang['admin']['event_desc_contenteditpost'] = 'Sent after edits to content are saved';
$lang['admin']['event_desc_contentdeletepre'] = 'Sent before content is deleted from the system';
$lang['admin']['event_desc_contentdeletepost'] = 'Sent after content is deleted from the system';
$lang['admin']['event_desc_contentstylesheet'] = 'Sent before the stylesheet is sent to the browser';
$lang['admin']['event_desc_contentprecompile'] = 'Sent before content is sent to smarty for processing';
$lang['admin']['event_desc_contentpostcompile'] = 'Sent after content has been processed by smarty';
$lang['admin']['event_desc_contentpostrender'] = 'Sent before the combined html is sent to the browser';
$lang['admin']['event_desc_smartyprecompile'] = 'Sent before any content destined for smarty is sent to for processing';
$lang['admin']['event_desc_smartypostcompile'] = 'Sent after any content destined for smarty has been processed';
$lang['admin']['event_help_loginpost'] = '<p>Sent after a user logs into the admin panel.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;user&#039; - Reference to the affected user object.</li>
</ul>
';
$lang['admin']['event_help_logoutpost'] = '<p>Sent after a user logs out of the admin panel.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;user&#039; - Reference to the affected user object.</li>
</ul>
';
$lang['admin']['event_help_adduserpre'] = '<p>Sent before a new user is created.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;user&#039; - Reference to the affected user object.</li>
</ul>
';
$lang['admin']['event_help_adduserpost'] = '<p>Sent after a new user is created.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;user&#039; - Reference to the affected user object.</li>
</ul>
';
$lang['admin']['event_help_edituserpre'] = '<p>Sent before edits to a user are saved.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;user&#039; - Reference to the affected user object.</li>
</ul>
';
$lang['admin']['event_help_edituserpost'] = '<p>Sent after edits to a user are saved.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;user&#039; - Reference to the affected user object.</li>
</ul>
';
$lang['admin']['event_help_deleteuserpre'] = '<p>Sent before a user is deleted from the system.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;user&#039; - Reference to the affected user object.</li>
</ul>
';
$lang['admin']['event_help_deleteuserpost'] = '<p>Sent after a user is deleted from the system.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;user&#039; - Reference to the affected user object.</li>
</ul>
';
$lang['admin']['event_help_addgrouppre'] = '<p>Sent before a new group is created.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;group&#039; - Reference to the affected group object.</li>
</ul>
';
$lang['admin']['event_help_addgrouppost'] = '<p>Sent after a new group is created.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;group&#039; - Reference to the affected group object.</li>
</ul>
';
$lang['admin']['event_help_changegroupassignpre'] = '<p>Sent before group assignments are saved.</p>
<h4>Parameters></h4>
<ul>
<li>&#039;group&#039; - Reference to the group object.</li>
<li>&#039;users&#039; - Array of references to user objects belonging to the group.</li>
';
$lang['admin']['event_help_changegroupassignpost'] = '<p>Sent after group assignments are saved.</p>
<h4>Parameters></h4>
<ul>
<li>&#039;group&#039; - Reference to the affected group object.</li>
<li>&#039;users&#039; - Array of references to user objects now belonging to the affected group.</li>
';
$lang['admin']['event_help_editgrouppre'] = '<p>Sent before edits to a group are saved.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;group&#039; - Reference to the affected group object.</li>
</ul>
';
$lang['admin']['event_help_editgrouppost'] = '<p>Sent after edits to a group are saved.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;group&#039; - Reference to the affected group object.</li>
</ul>
';
$lang['admin']['event_help_deletegrouppre'] = '<p>Sent before a group is deleted from the system.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;group&#039; - Reference to the affected group object.</li>
</ul>
';
$lang['admin']['event_help_deletegrouppost'] = '<p>Sent after a group is deleted from the system.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;group&#039; - Reference to the affected group object.</li>
</ul>
';
$lang['admin']['event_help_addstylesheetpre'] = '<p>Sent before a new stylesheet is created.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;stylesheet&#039; - Reference to the affected stylesheet object.</li>
</ul>
';
$lang['admin']['event_help_addstylesheetpost'] = '<p>Sent after a new stylesheet is created.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;stylesheet&#039; - Reference to the affected stylesheet object.</li>
</ul>
';
$lang['admin']['event_help_editstylesheetpre'] = '<p>Sent before edits to a stylesheet are saved.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;stylesheet&#039; - Reference to the affected stylesheet object.</li>
</ul>
';
$lang['admin']['event_help_editstylesheetpost'] = '<p>Sent after edits to a stylesheet are saved.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;stylesheet&#039; - Reference to the affected stylesheet object.</li>
</ul>
';
$lang['admin']['event_help_deletestylesheetpre'] = '<p>Sent before a stylesheet is deleted from the system.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;stylesheet&#039; - Reference to the affected stylesheet object.</li>
</ul>
';
$lang['admin']['event_help_deletestylesheetpost'] = '<p>Sent after a stylesheet is deleted from the system.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;stylesheet&#039; - Reference to the affected stylesheet object.</li>
</ul>
';
$lang['admin']['event_help_addtemplatepre'] = '<p>Sent before a new template is created.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;template&#039; - Reference to the affected template object.</li>
</ul>
';
$lang['admin']['event_help_addtemplatepost'] = '<p>Sent after a new template is created.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;template&#039; - Reference to the affected template object.</li>
</ul>
';
$lang['admin']['event_help_edittemplatepre'] = '<p>Sent before edits to a template are saved.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;template&#039; - Reference to the affected template object.</li>
</ul>
';
$lang['admin']['event_help_edittemplatepost'] = '<p>Sent after edits to a template are saved.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;template&#039; - Reference to the affected template object.</li>
</ul>
';
$lang['admin']['event_help_deletetemplatepre'] = '<p>Sent before a template is deleted from the system.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;template&#039; - Reference to the affected template object.</li>
</ul>
';
$lang['admin']['event_help_deletetemplatepost'] = '<p>Sent after a template is deleted from the system.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;template&#039; - Reference to the affected template object.</li>
</ul>
';
$lang['admin']['event_help_templateprecompile'] = '<p>Sent before a template is sent to smarty for processing.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;template&#039; - Reference to the affected template text.</li>
</ul>
';
$lang['admin']['event_help_templatepostcompile'] = '<p>Sent after a template has been processed by smarty.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;template&#039; - Reference to the affected template text.</li>
</ul>
';
$lang['admin']['event_help_addglobalcontentpre'] = '<p>Sent before a new global content block is created.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;global_content&#039; - Reference to the affected global content block object.</li>
</ul>
';
$lang['admin']['event_help_addglobalcontentpost'] = '<p>Sent after a new global content block is created.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;global_content&#039; - Reference to the affected global content block object.</li>
</ul>
';
$lang['admin']['event_help_editglobalcontentpre'] = '<p>Sent before edits to a global content block are saved.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;global_content&#039; - Reference to the affected global content block object.</li>
</ul>
';
$lang['admin']['event_help_editglobalcontentpost'] = '<p>Sent after edits to a global content block are saved.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;global_content&#039; - Reference to the affected global content block object.</li>
</ul>
';
$lang['admin']['event_help_deleteglobalcontentpre'] = '<p>Sent before a global content block is deleted from the system.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;global_content&#039; - Reference to the affected global content block object.</li>
</ul>
';
$lang['admin']['event_help_deleteglobalcontentpost'] = '<p>Sent after a global content block is deleted from the system.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;global_content&#039; - Reference to the affected global content block object.</li>
</ul>
';
$lang['admin']['event_help_globalcontentprecompile'] = '<p>Sent before a global content block is sent to smarty for processing.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;global_content&#039; - Reference to the affected global content block text.</li>
</ul>
';
$lang['admin']['event_help_globalcontentpostcompile'] = '<p>Sent after a global content block has been processed by smarty.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;global_content&#039; - Reference to the affected global content block text.</li>
</ul>
';
$lang['admin']['event_help_contenteditpre'] = '<p>Sent before edits to content are saved.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;global_content&#039; - Reference to the affected content object.</li>
</ul>
';
$lang['admin']['event_help_contenteditpost'] = '<p>Sent after edits to content are saved.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;content&#039; - Reference to the affected content object.</li>
</ul>
';
$lang['admin']['event_help_contentdeletepre'] = '<p>Sent before content is deleted from the system.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;content&#039; - Reference to the affected content object.</li>
</ul>
';
$lang['admin']['event_help_contentdeletepost'] = '<p>Sent after content is deleted from the system.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;content&#039; - Reference to the affected content object.</li>
</ul>
';
$lang['admin']['event_help_contentstylesheet'] = '<p>Sent before the sytlesheet is sent to the browser.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;content&#039; - Reference to the affected stylesheet text.</li>
</ul>
';
$lang['admin']['event_help_contentprecompile'] = '<p>Sent before content is sent to smarty for processing.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;content&#039; - Reference to the affected content text.</li>
</ul>
';
$lang['admin']['event_help_contentpostcompile'] = '<p>Sent after content has been processed by smarty.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;content&#039; - Reference to the affected content text.</li>
</ul>
';
$lang['admin']['event_help_contentpostrender'] = '<p>Sent before the combined html is sent to the browser.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;content&#039; - Reference to the html text.</li>
</ul>
';
$lang['admin']['event_help_smartyprecompile'] = '<p>Sent before any content destined for smarty is sent to for processing.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;content&#039; - Reference to the affected text.</li>
</ul>
';
$lang['admin']['event_help_smartypostcompile'] = '<p>Sent after any content destined for smarty has been processed.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;content&#039; - Reference to the affected text.</li>
</ul>
';
$lang['admin']['filterbymodule'] = 'Filter By Module';
$lang['admin']['showall'] = 'همه را نشان بده';
$lang['admin']['core'] = 'هسته';
$lang['admin']['defaultpagecontent'] = 'صفحه محتوای پیش&zwnj;فرض';
$lang['admin']['file_url'] = 'Link to file (instead of URL)';
$lang['admin']['no_file_url'] = 'None (Use URL Above)';
$lang['admin']['defaultparentpage'] = 'Default Parent Page';
$lang['admin']['error_udt_name_whitespace'] = 'Error: User Defined Tags cannot have spaces in their name.';
$lang['admin']['warning_safe_mode'] = '<strong><em>اخطار:</em></strong>در تنظیم&zwnj;های PHP میزبان شما Safe mode فعال است! این می&zwnj;تواند بارگذاری فایل&zwnj;هایتان از طریق مرورگر اینترنتی  را دچار اختلال کند؛ مانند قالب&zwnj;ها، ماژول&zwnj;ها، تصاویر و بسته&zwnj;های XML. با مدیریت میزبان خود تماس بگیرید تا این موضوع را مرتفع نمایند.';
$lang['admin']['test'] = 'بررسی';
$lang['admin']['results'] = 'نتايج';
$lang['admin']['untested'] = 'بررسی نشده';
$lang['admin']['unknown'] = 'ناشناخته';
$lang['admin']['download'] = 'دریافت';
$lang['admin']['frontendwysiwygtouse'] = 'Frontend wysiwyg';
$lang['admin']['all_groups'] = 'همه گروه&zwnj;ها';
$lang['admin']['error_type'] = 'نوع خطا';
$lang['admin']['contenttype_errorpage'] = 'صفحه خطا';
$lang['admin']['errorpagealreadyinuse'] = 'Error Code Already in Use';
$lang['admin']['404description'] = 'صفحه یافت نشد';
$lang['admin']['usernotfound'] = 'شناسه موجود نیست';
$lang['admin']['passwordchange'] = 'Please, provide the new password';
$lang['admin']['recoveryemailsent'] = 'Email sent to recorded address.  Please check your inbox for further instructions.';
$lang['admin']['errorsendingemail'] = 'There was an error sending the email.  Contact your administrator.';
$lang['admin']['passwordchangedlogin'] = 'Password changed.  Please log in using the new credentials.';
$lang['admin']['nopasswordforrecovery'] = 'No email address set for this user.  Password recovery is not possible.  Please contact your administrator.';
$lang['admin']['lostpw'] = 'رمزعبور خود را فراموش کرده&zwnj;ايد؟';
$lang['admin']['lostpwemailsubject'] = '[%s] بازيابی رمزعبور';
$lang['admin']['lostpwemail'] = 'You are recieving this e-mail because a request has been made to change the (%s) password associated with this user account (%s).  If you would like to reset the password for this account simply click on the link below or paste it into the url field on your favorite browser:
%s

If you feel this is incorrect or made in error, simply ignore the email and nothing will change.';
$lang['admin']['utma'] = '156861353.710420388.1316517713.1316945294.1316950101.10';
$lang['admin']['utmz'] = '156861353.1316945294.9.3.utmccn=(referral)|utmcsr=dev.cmsmadesimple.org|utmcct=/projects/cmsms-persian|utmcmd=referral';
$lang['admin']['qca'] = 'P0-757906974-1307033581752';
$lang['admin']['utmc'] = '156861353';
$lang['admin']['utmb'] = '156861353';
?>