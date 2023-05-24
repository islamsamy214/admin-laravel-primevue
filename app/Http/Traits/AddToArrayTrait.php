<?php

namespace App\Http\Traits;

trait addToArrayTrait
{
    public function addToEachArray($array, $key, $value)
    {
        foreach ($array as $k => $v) {
            $array[$k][$key] = $value;
        }
        return $array;
    }

    public function addToArray($array, $key, $value)
    {
        $array[$key] = $value;
        return $array;
    }

    public function addToIndex($array, $index, $key, $value)
    {
        $array[$index][$key] = $value;
        return $array;
    }

    public function removeFromArray($array, $value)
    {
        $key = array_search($value, $array);
        unset($array[$key]);
        return $array;
    }

    public function removeFromArrayByIndex($array, $index)
    {
        unset($array[$index]);
        return $array;
    }
}
