<?php
function smarty_modifier_br2nl($string)
{
    return str_replace("<br>", "\n", str_replace("<br />", "\n", str_replace("<br/>", "\n",$string)));
}

/* vim: set expandtab: */

?>
