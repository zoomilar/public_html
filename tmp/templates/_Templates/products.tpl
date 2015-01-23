{assign var="vidinis" value=1}	
{cms_include tpl="header"}
{*}
    <ul class="path">
        <li>{cms_selflink page=$kalba menu=1}</li><li>{products_hierarchy_breadcrumb delim="</li><li>" hierarchyid=$active_hierarchy kalba=$kalba last_no_link=1}</li>
    </ul>
{*}
{*}
	{if $cat_page == 1}
		{Products action="hierarchy" hierarchytemplate="cat_page" parent=$parent}
	{else}
		<div id="sidebar">
			{if $its_a_f_product > 0}
				{Products action="hierarchy" hierarchytemplate="side_menu" parent=$parent}
			{else}
				{Products action="hierarchy" hierarchytemplate="side_menu" parent=$parent2}
			{/if}
			</br>
			{Products action="filter"}
		</div>
		<div id="mainbar">
			{content}
		</div>
	{/if}
{*}	
{cms_include tpl="footer"}