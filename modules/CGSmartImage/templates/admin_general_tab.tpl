{$formstart}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_croptofit_default_loc')}:</p>
  <p class="pageinput">
    <select name="{$actionid}croptofit_default_loc">
    {html_options options=$croptofit_locs selected=$croptofit_default_loc}
    </select>
    <br/>
    {$mod->Lang('info_croptofit_default_loc')}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('max_cache_age')}:</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}cache_age" value="{$cache_age}" size="3" maxlength="3"/>
    <input type="submit" name="{$actionid}clear_now" value="{$mod->Lang('clear_now')}"/>
    <input type="submit" name="{$actionid}clear_all" value="{$mod->Lang('clear_all')}" onclick="return confirm('{$mod->Lang('ask_clear_image_cache')}');"/>
    <br/>
    {$mod->Lang('info_cache_age')}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('cache_path')}:</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}cache_path" value="{$cache_path}" size="40" maxlength="255"/>
    <br/>
    {$mod->Lang('info_cache_path')}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('image_url_prefix')}:</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}image_url_prefix" value="{$image_url_prefix}" size="40" maxlength="255"/>
    <br/>
    {$mod->Lang('info_image_url_prefix')}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('image_url_hascachedir')}:</p>
  <p class="pageinput">
    {cge_yesno_options prefix=$actionid name='image_url_hascachedir' selected=$image_url_hascachedir}
    <br/>
    {$mod->Lang('info_image_url_hascachedir')}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext"></p>
  <p class="pageinput">
    <input type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}"/>
  </p>
</div>
{$formend}