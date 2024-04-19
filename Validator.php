<?php

namespace feedback_admin\validation;

use feedback_admin\validation\classes\Validations;
use feedback_admin\validation\classes\Rules;


class Validator extends Validations
{
    private $scheme = [];
    private $errors = [];
    private $valid = true;


    function __construct($scheme)
    {
        $this->scheme = $scheme;
    }

    function checkRulesInstance($field, $rule)
    {
        if (!$rule instanceof Rules) {
            if (!$this->errors[$field]) $this->errors[$field] = [];

            array_push($this->errors[$field], "not a rule's instance");
            $this->valid = false;

            return false;
        }

        return true;
    }

    function checkDatasExistence($field, $data)
    {
        if (!array_key_exists($field, $data)) {
            if (!$this->errors[$field]) $this->errors[$field] = [];

            array_push($this->errors[$field], "field doesn't exist");
            $this->valid = false;

            return false;
        }

        return true;
    }

    function iterateRuleValidation($field, $rules, $value)
    {
        foreach ($rules->getValidationMethods() as $rule) {
            $validation_res = $this->{$rule['method']}($value, $rule['condition']);

            if ($validation_res['valid']) continue;
            if (!$this->errors[$field]) $this->errors[$field] = [];

            array_push($this->errors[$field], $validation_res['message']);
            $this->valid = false;
        }
    }

    function validate($data)
    {
        foreach ($this->scheme as $field => $rules) {
            if (!$this->checkRulesInstance($field, $rules)) continue;
            if (!$this->checkDatasExistence($field, $data)) continue;

            $this->iterateRuleValidation($field, $rules, $data[$field]);
        }

        return [
            "valid" => $this->valid,
            "errors" => $this->errors
        ];
    }
}
