<?php
class Sanitizer
{
    static function sanitizeString($string)
    {
        $string = strip_tags($string);
        $string = htmlentities($string);
        return stripcslashes($string);
    }       
}

?>