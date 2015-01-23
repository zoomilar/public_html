<h3>{$mod->Lang('export_to_csv')}</h3>
{$formstart}

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('exportdelim')}</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}exportdelim" value="{$options.exportdelim}" size="5" maxlength="5"/>
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('exportdraft')}</p>
  <p class="pageinput">
    {cge_yesno_options prefix=$actionid name=exportdraft selected=$options.exportdraft}
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('exportcats')}</p>
  <p class="pageinput">
    {cge_yesno_options prefix=$actionid name=exportcats selected=$options.exportcats}
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('exportfields')}</p>
  <p class="pageinput">
    {cge_yesno_options prefix=$actionid name=exportfields selected=$options.exportfields}
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('exportattribs')}</p>
  <p class="pageinput">
    {cge_yesno_options prefix=$actionid name=exportattribs selected=$options.exportattribs}
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext"></p>
  <p class="pageinput">
    <input type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}"/>
    <input type="submit" name="{$actionid}cancel" value="{$mod->Lang('cancel')}"/>
  </p>
</div>
{$formend}