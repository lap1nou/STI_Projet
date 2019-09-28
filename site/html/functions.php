<?php
    /**
     * Check if a variable is not empty and is set.
     */
    function isValid($variable){
        return isset($variable) && !empty($variable);
    }
?>