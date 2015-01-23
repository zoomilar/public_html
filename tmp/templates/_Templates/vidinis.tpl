{assign var="vidinis" value=1}	
{cms_include tpl="header"}

<div class="path_block">
    <div class="go_back_place fr">
        <a href="#" class="go_back">{#atgal#}</a>
    </div>
    <ul class="path">
        <li>{Breadcrumbs delimiter="</li><li>"}</li>
    </ul>
</div>
<div class="section">
	<h1 class="main_title">{title}</h1>
    {menu template="side_meniu" start_level=4 number_of_levels="1" assign="leftmenu"}
    {$leftmenu}
    <div id="mainbar">
    	{content_module block="filepicker_block" module="GBFilePicker" label="Puslapio foninis paveiksliukas" allow_scaling="false" mode="browser" dir="images/pages/" assign="page_background_image"}
    	{content}
		{content block="gallery" label="Galerija" oneline="1" assign="gallery"}
		{if $gallery}
			{Gallery dir=$gallery}
		{/if}
		
		{if $show_map == 1}
			{$kalba|mapc:"1":"100%,300px":"54.725956, 25.295587":0:0:$smarty.config.zemelapis:$smarty.config.zemelapis2}
		{/if}
    </div>
</div>
{if $page_background_image}
    {literal}
        <style>
            #page{
                background:url(/uploads/{/literal}{$page_background_image}{literal}) center center no-repeat;
                background-size:cover;
                background-attachment:fixed
            }
        </style>
    {/literal}
{/if}				
{cms_include tpl="footer"}