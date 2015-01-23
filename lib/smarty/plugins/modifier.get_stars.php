<?php
function smarty_modifier_get_stars($string)
{
    return round(intval($string) / 20);
} 
?>