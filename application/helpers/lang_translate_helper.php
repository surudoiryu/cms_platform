<?php

function label($label, $obj)
{
    $return = $obj->lang->line($label);
    if($return)
        return $return;
    else
        return $label;
}

?>