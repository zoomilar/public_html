<!-- change settings template -->
{$title}
{if isset($message) && $message != ''}
  {if isset($error) && $error != ''}
    <p><font color="red">{$message}</font></p>
  {else}
    <p>{$message}</p>
  {/if}
{/if}
{$startform}
 {if $controlcount > 0}
  <center>
  <table width="75%">
     {foreach from=$controls item=control}
  <tr>
     <td>{if isset($control->hidden)}{$control->hidden}{/if}<font color="{$control->color}">{$control->prompt}{$control->marker}</font></td>
     <td>
       {if isset($control->image)}{$control->image}<br/>{/if}
       {$control->control}{$control->addtext|default:''}
       {if isset($control->control2)}{$control->prompt2}&nbsp;{$control->control2}<br/>{/if}
     </td>
  </tr>
 {/foreach}
  </table>
  </center>
 {/if}
 {$hidden|default:''}{$hidden2|default:''}{$submit}
{$endform}
<!-- change settings template -->
