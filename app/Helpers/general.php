<?php
    function set_alert($type, $message)
    {
        session()->put('type',$type);
    }
?>