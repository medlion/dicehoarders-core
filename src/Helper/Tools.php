<?php


namespace App\Helper;


class Tools
{
    public static function snakeCaseToCamelCase($string, $capitalizeFirstCharacter = false)
    {

        $str = str_replace('_', '', ucwords($string, '_'));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
    }
}