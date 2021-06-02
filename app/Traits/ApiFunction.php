<?php

namespace App\Traits;

trait ApiFunction
{
    function handleNull($array)
    {
        $data_arr = json_decode(json_encode($array), true);
        $data = array_map(function ($value) {
            return $value === NULL ? "" : $value;
        }, $data_arr);
        return $data;
    }

    function handleNullMultiDimensi($array)
    {
        $data = json_decode(json_encode($array), true);
        array_walk_recursive($data, 'self::replaceNullValueWithEmptyString');
        return $data;
    }

    function replaceNullValueWithEmptyString(&$value)
    {
        return $value = $value === null ? "" : $value;
    }


}
