		{$hid}
	<div class="pageoverflow">
		<a name="fok"></a><p class="pagetext">&nbsp;</p>
		
		<p class="pageinput">{$submit}{$cancel}{$change}</p>
	</div>

{foreach from=$props item=prop key=k}	
	<div class="pageoverflow">
	 {if $prop->type != "hidden"}
		<p class="pagetext">{$mod->Lang($prop->title)}:</p>
		<p class="pageinput">
			
		
		{if $prop->type == "upload"}
			<a href="/uploads/images/titulinis/{$f->$k}" target="_blank"><img src="/uploads/images/titulinis/{$f->$k}" /></a><br/><br/>
			{if $prop->chechbox}
				Trinti: {$prop->checkbox}
			{/if}
		{/if}
	  {/if}	
		{$prop->field}	
	</div>	     

{/foreach}
	
	<div class="pageoverflow">
		<p class="pagetext">&nbsp;</p>
		<p class="pageinput">{$submit}{$cancel}{$change}</p>
	</div>
