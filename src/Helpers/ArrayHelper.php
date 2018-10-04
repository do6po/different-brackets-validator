<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 03.10.18
 * Time: 15:24
 */

namespace Src\Helpers;


class ArrayHelper
{
    public static function getLastElementOfArray(array $array)
    {
        return end($array);
    }
}