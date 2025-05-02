<?php

namespace Innoboxrr\Deals\Support\Helpers;

class ArrayHelper
{
    public static function dotNotationToNestedArray(array $flat): array
    {
        $nested = [];

        foreach ($flat as $path => $value) {
            $keys = explode('.', $path);
            $temp = &$nested;

            foreach ($keys as $key) {
                if (!isset($temp[$key]) || !is_array($temp[$key])) {
                    $temp[$key] = [];
                }
                $temp = &$temp[$key];
            }

            $temp = $value;
        }

        return $nested;
    }

    public static function nestedArrayToDotNotation(array $nested, string $prefix = ''): array
    {
        $flat = [];

        foreach ($nested as $key => $value) {
            if (is_array($value)) {
                $flat = array_merge($flat, self::nestedArrayToDotNotation($value, $prefix . $key . '.'));
            } else {
                $flat[$prefix . $key] = $value;
            }
        }

        return $flat;
    }
}