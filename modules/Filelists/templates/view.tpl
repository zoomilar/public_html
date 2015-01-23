{if $not_found}
	<h2 style="margin-top:15px;">{#filelist_not_found#}</h2>
{else}
	{if $add_edit}
		<a href="{$add_edit}" class="ext_button red f_22 fr">
			<span>{#add_filelist#}</span>
		</a>
	{/if}
	<h1 class="f_36 font_sacramento-regular-webfont nouppercase custom_title">{title}</h1>
	<div class="back_place" align="right">
		<a href="javascript:window.history.back();" class="styled_link f_12">
			<span class="ico left">
				<img src="images/icons/ico_6.png"  alt=""/>
			</span>
			<span><strong>{#atgal#}</strong></span>
		</a>
	</div>
	<div class="recepies_list">
		<div>
			{if $rec.files|@count > 0}
				<div class="recepie_gallery">
				  <div class="recepie_slider_container"> 
					<div class="cycle-slideshow recepie_slider" 
							data-cycle-fx="scrollHorz" 
							data-cycle-timeout="200000"
							data-cycle-slides="> div"
							data-cycle-pager=".recepie_slider_pagination > span"
							data-cycle-pause-on-hover="true"
							data-cycle-prev=".recepie_slider_back"
							data-cycle-next=".recepie_slider_next"
							>
							{foreach from=$rec.files item="img"}
								<div>
									<a href="{$img.full}" class="fancybox" rel="grup">{CGSmartImage src=$img.full filter_croptofit='216,216,c' noautoscale='false'}</a>
								</div>
							{/foreach}
						</div>
					</div>
					<div class="recepie_slider_pagination">
						<a href="#" class="recepie_slider_back"><span></span></a>
						<a href="#" class="recepie_slider_next"><span></span></a>
						<span></span>
					</div>
					<div>
						<img src="images/misc/social.png" width="98" height="20"  alt=""/>
					</div>
				</div>
			{/if}
			<div class="cont">
				<h2>{eval var=$rec.filename}</h2>
				<div class="f_14">
					<p>
						<strong>{$rec.short_desc}</strong>
					</p>
					<h3 class="f_15 red_color">{#you_will_need#}:</h3>
					<div>
						{$rec.detail}
					</div>
					<br />
					<h3 class="f_15 red_color">{#makeing#}:</h3>
					<div>
						{$rec.cooking_course}
					</div>
				</div>
			</div>
		</div>
	</div>
	{*<pre>
	{$rec|@print_r}
	</pre>*}
{/if}
