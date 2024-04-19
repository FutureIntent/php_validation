<?php

namespace feedback_admin\validation\interfaces;


interface ValidationInterface
{
    public function checkRequirement($value, $isRequired);
    public function checkType($value, $requiredType);
    public function checkDate($value, $dateFormat);
    public function matchPattern($value, $pattern);
}
