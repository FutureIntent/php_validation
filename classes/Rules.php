<?php

namespace feedback_admin\validation\classes;

class Rules
{
    private $validations = [];

    function __construct()
    {
    }


    ///SETTERS///
    function setRequired($required)
    {
        array_push($this->validations, [
            'condition' => $required,
            'method' => 'checkRequirement'
        ]);

        return $this;
    }

    function setType($type)
    {
        array_push($this->validations, [
            'condition' => $type,
            'method' => 'checkType'
        ]);

        return $this;
    }

    function setDate($dateFormat)
    {
        array_push($this->validations, [
            'condition' => $dateFormat,
            'method' => 'checkDate'
        ]);

        return $this;
    }

    function setPattern($pattern)
    {
        array_push($this->validations, [
            'condition' => $pattern,
            'method' => 'matchPattern'
        ]);

        return $this;
    }


    ///GETTERS///
    function getValidationMethods()
    {
        return $this->validations;
    }
}
