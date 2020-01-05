<?php
    /**
     * Check if a variable is not empty and is set.
     */
    function isValid($variable){
        return isset($variable) && !empty($variable);
    }

    /**
     * Check if the token is correct
     */
    function verifyToken($token){
        if (!empty($token)) return hash_equals($_SESSION['token'], $token);
    }
?>