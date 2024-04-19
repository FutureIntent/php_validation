<?php

namespace classes;

use DateTime;
use Exception;
use interfaces\ValidationInterface;


abstract class Validations implements ValidationInterface
{
    function checkRequirement($value, $isRequired)
    {
        try {
            if ($isRequired && (trim($value) === "" || !isset($value))) throw new Exception("field is required");
        } catch (Exception $err) {

            return [
                "valid" => false,
                "message" => $err->getMessage()
            ];
        }

        return ["valid" => true];
    }

    function checkType($value, $requiredType)
    {
        $php_func = "is_{$requiredType}";

        try {
            if (!$php_func($value)) throw new Exception("required type is {$requiredType}");
        } catch (Exception $err) {

            return [
                "valid" => false,
                "message" => $err->getMessage()
            ];
        }

        return ["valid" => true];
    }

    function checkDate($value, $dateFormat)
    {
        try {
            $date = DateTime::createFromFormat($dateFormat, $value);

            if (!($date && $date->format($dateFormat) === $value)) throw new Exception("required date format is {$dateFormat}");
        } catch (Exception $err) {

            return [
                "valid" => false,
                "message" => $err->getMessage()
            ];
        }

        return ["valid" => true];
    }

    function matchPattern($value, $pattern)
    {
        try {
            if (!preg_match($pattern, $value)) throw new Exception("provided value doesn't match pattern");
        } catch (Exception $err) {

            return [
                "valid" => false,
                "message" => $err->getMessage()
            ];
        }

        return ["valid" => true];
    }
}
