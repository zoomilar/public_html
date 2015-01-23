{literal}
<script type="text/javascript">
$(document).ready(function() {
	$(".komm").click(function(){
	
		var kla = $(this).attr('alt');
		
		$(".komm").removeClass('active');
		$(this).addClass('active');
		var lang = $(this).attr("alt");
		$(".komm[alt='"+lang+"']").addClass('active');
		$(".hddi").hide();
		$("."+kla).show();
	});
});	
</script>
<style>
  .komm.active{
		text-decoration: underline;
  }
</style>
{/literal}


		{$hid}
	<div class="pageoverflow">
		<a name="fok"></a><p class="pagetext">&nbsp;</p>
		
		<p class="pageinput">{$submit}{$cancel}{$change}</p>
	</div>
    {foreach from=$titulinio_tabai item=tabas}
    	{if $smarty.get.m1_kat == $tabas.title}
            {foreach from=$props item=prop key=k}	
             {if $a->$k}
             	{foreach from=$tabas.allowed_inputs item=alowed_input}
                    {if $k == $alowed_input}
                    	<div class="pageoverflow"{if $k == "kalba"} style="display: none"{/if}>	
                            <p class="pagetext"> {if $k=="paveiksliukas"}{$t->$k}{elseif $t->$k}{$t->$k}{else}{$k}{/if}:</p>
                         {if $k=="kalba"} 
                            <p class="pageinput">
                                {html_options name=$k options=$kalbos selected=$r->$k}
                            </p>
                         {elseif ($k=="paveiksliukas" || $k=="paveiksliukas2") && $f->$k}
                            <p class="pageinput">{if $f->$k}
                            <img src="{root_url}/uploads/images/titulinis/{$f->$k}" style="width: 80px">
                            <br />{$a->$k} {$Titulinis->lang(del)}: {$d->$k}{/if}</p>
                         {else}						
                            <p class="pageinput">{$a->$k} {if $f->$k}<a href="{root_url}/uploads/images/titulinis/{$f->$k}" target="_blank">{$f->$k}</a> {$Titulinis->lang(del)}: {$d->$k}{/if}</p>	
                         {/if}	
                        </div>	
                    {else}	
                    {/if}
                {/foreach}   
             {/if}
            {/foreach}	
        {/if}
    {/foreach}	
	
	<input type="hidden" name="m1_kat" value="{$smarty.get.m1_kat}"/>

	<div class="pageoverflow">
		<p class="pagetext">&nbsp;</p>
		<p class="pageinput">{$submit}{$cancel}{$change}</p>
	</div>
