{$formstart}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_company')}:*</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}company" size="50" maxlength="255" value="{$my_address->get_company()}"/>
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_firstname')}:</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}firstname" size="50" maxlength="50" value="{$my_address->get_firstname()}"/>
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_lastname')}:</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}lastname" size="50" maxlength="50" value="{$my_address->get_lastname()}"/>
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_address1')}:*</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}address1" size="50" maxlength="100" value="{$my_address->get_address1()}"/>
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_address2')}:</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}address2" size="50" maxlength="100" value="{$my_address->get_address2()}"/>
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_city')}:*</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}city" size="20" maxlength="50" value="{$my_address->get_city()}"/>
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_state')}:</p>
  <p class="pageinput">
    <select name="{$actionid}state">
    {html_options options=$state_list selected=$my_address->get_state()}
    </select>
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_postal')}:</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}postal" size="10" maxlength="25" value="{$my_address->get_postal()}"/>
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_country')}:*</p>
  <p class="pageinput">
    <select name="{$actionid}country">
    {html_options options=$country_list selected=$my_address->get_country()}
    </select>
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_phone')}:*</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}phone" size="12" maxlength="25" value="{$my_address->get_phone()}"/>
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_fax')}:</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}fax" size="12" maxlength="25" value="{$my_address->get_fax()}"/>
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_email')}:*</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}email" size="50" maxlength="255" value="{$my_address->get_email()}"/>
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext"></p>
  <p class="pageinput">
    <input type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}"/>
  </p>
</div>
{$formend}