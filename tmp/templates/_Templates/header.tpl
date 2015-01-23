{process_pagedata}
{capture assign="kalbumeniu"}
    {menu template="lang" number_of_levels="1"}
{/capture}
{if $kalba != ''}
	{config_load file="../../tmp/languages/`$kalba`.conf" section = "strings" scope="global"}
{/if}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lt IE 7]>      <html xmlns="http://www.w3.org/1999/xhtml" class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html xmlns="http://www.w3.org/1999/xhtml" class="lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html xmlns="http://www.w3.org/1999/xhtml" class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html xmlns="http://www.w3.org/1999/xhtml"> <!--<![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>{title} - {sitename}</title>
    <base href="{root_url}"/>
    {metadata}

{*}
    <script src="/js/plugins/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
    <script src="/js/plugins/fancybox/helpers/jquery.fancybox-media.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="js/plugins/fancybox/jquery.fancybox.css" />
    <script src="/js/plugins/fancybox/launch.js" type="text/javascript"></script>
    <script type="text/javascript">
        var user_name = '{#user_name#}';
        var user_pass = '{#user_pass#}';
    </script>
{*}
</head>

<body>
        	{*}
				<a href="/{if $kalba !="lt"}{$kalba}/{/if}" class="logo"></a>
            	{$kalbumeniu}
                {menu template="topmenu" start_element=$smarty.config.topmenu number_of_levels="2"}
				{Products action="hierarchy"}
			{*}