{if $irasai|@count>0}
	<div class="galery ">
		<div class="items">
		{foreach from=$irasai item="entry"}
			{capture assign="image_url"}{if $entry.paveiksliukas}{root_url}/uploads/images/titulinis/{$entry.paveiksliukas}{/if}{/capture}
			<div class="item" style="background:url('{CGSmartImage src=$image_url filter_croptofit='1460,782,c,1' noautoscale='false' notag=1}') no-repeat center center;background-size:cover;">
				{if $entry.nuoroda}<a href="{$entry.nuoroda}">{/if}{CGSmartImage src=$image_url filter_croptofit='1460,782,c,1' noautoscale='false'}{if $entry.nuoroda}</a>{/if}
				{if $entry.tekstas}
				<div class="pos">
					<div class="center">
						<div class="text fr">
							{$entry.tekstas}
							{if $entry.nuoroda}
							<a href="{$entry.nuoroda}" class="button s-button-2 fr">
								<span>{#more#}</span>
								<span></span>
							</a>
							{/if}
						</div>
					</div>
				</div>
				{/if}
			</div>
		{/foreach}
		</div>
		<div class="auxiliary">
			<div class="bullets">
				<div class="clearfix"></div>
			</div>
			<div class="center" style="position:relative;">
				<div class="nav">
					<a href="#" class="next fr"></a>
					<a href="#" class="prev fl"></a>
				</div>
			</div>
		</div>
		{Titulinis kategorija="blobs" kalba=$kalba}
	</div>
{/if}