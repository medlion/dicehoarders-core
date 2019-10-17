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


    /**
     * This is a generic function to append two things. This is particularly useful for item overrides that needs to be appended
     *
     * @param $partone
     * @param $parttwo
     * @return array|int|string
     * @throws \Exception
     */
    public static function append ($partone, $parttwo)
    {
        if (ctype_digit($partone)) {
            $partone = (float) $partone;
        }

        if (ctype_digit($parttwo)) {
            $parttwo = (float) $parttwo;
        }

        if (is_numeric($partone) && is_numeric($parttwo)) {
            if ((int)($partone + $parttwo) === ($partone + $parttwo)) {
                return (int)($partone+$parttwo);
            }
            return $partone+$parttwo;
        }

        if (is_array($partone) || is_array($parttwo)) {
            if (is_array($partone) && is_array($parttwo)) {
                return array_merge($partone, $parttwo);
            }
            throw new \Exception('Do not try to append a non array to an array');
        }

        return $partone . PHP_EOL . $parttwo;
    }
}
