<h3>{$mod->Lang('import_from_csv')}</h3>
<style type="text/css">{literal}
#errorblock { display: none; }
#optionblock { display: none; }
#processblock { display: none; }
#progress { width: 90%; text-align: center; }
{/literal}</style>

<script type="text/javascript">{literal}
$(function(){
  $('#progress').progressbar({value: 0});
  $('#returnbtn').click(function(){
    window.location = '{/literal}{$doneurl}{literal}';
  });
});
function progress(pct) {
  $('#progress').progressbar('value',pct);
  $('.ui-progressbar-value').html(pct+'%');
}
function onError(str) {
  $('#errorblock').show();
  $('#errors').val($('#errors').val()+str+'\n');
}
function done() {
  $('#optionblock').fadeIn();
}
{/literal}</script>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('progress')}:</p>
  <p class="pageinput" id="progress"></p>
</div>

<div class="pageoverflow" id="errorblock">
  <p class="pagetext">{$mod->Lang('errors')}:</p>
  <p class="pageinput">
    <textarea id="errors"></textarea>
  </p>
</div>

<div class="ageoverflow" id="optionblock">
  <p class="pagetext"></p>
  <p class="pageinput">
    <input type="submit" id="returnbtn" value="{$mod->Lang('return')}"/>
  </p>
</div>

<iframe src="{$processurl}" id="processblock"></iframe>