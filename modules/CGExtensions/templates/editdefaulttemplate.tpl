<script type="text/javascript">{literal}
$(document).ready(function(){
  $('#{/literal}{$prefname}_tpl{literal}').hide();
  $('#{/literal}{$prefname}{literal}').click(function(){
    if( ! $('#{/literal}{$prefname}_tpl{literal}').is(':visible') ) {
      $('.cge_dflt_template').hide('fast');
      $('#{/literal}{$prefname}_tpl{literal}').show('slow');
    }
  });
  $('.cge_dflt_template').first().show();
});
{/literal}</script>
{$startform}
  <div class="pageoverflow">
  <h4 id="{$prefname}"><a href="javascript:void()"><span class="cge_toggle">+</span>&nbsp;{$defaulttemplateform_title}</a></h4>
  {if isset($info_title) && $info_title}
    <em>{$info_title}</em><br/>
  {/if}
  </div>
  <div class="pageoverflow cge_dflt_template" id="{$prefname}_tpl">
    <p class="pagetext">{$prompt_template}:</p>
    <p class="pageinput">{$input_template}
      <br/>{$submit}{$reset}
    </p>
  </div>
{$endform}
<br/>