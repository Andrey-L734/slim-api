<?php

namespace App;

class Validator
{
    private static array $fields = [
        "clientId" => false,
        "sum" => false,
        "returnDate" => false,
        "rate" => false
    ];

    public static function validate(array $data): array|bool
    {
        $result = 0;

        foreach ($data as $key => $value) {
            if (array_key_exists($key, self::$fields)) {
                self::$fields[$key] = self::$key($value);
                if (self::$fields[$key]) {
                    $result++;
                }
            }
        }

        return $result == count(self::$fields) ? $result : self::$fields;
    }

    private static function clientId($value): bool
    {
        return is_integer($value);
    }

    private static function sum($value): bool
    {
        return is_integer($value);
    }

    private static function returnDate($value): bool
    {
        return (bool)preg_match("/^\d{2}-\d{2}-\d{4}$/", $value);
    }

    private static function rate($value): bool
    {
        return is_integer($value) || is_float($value);
    }
}

