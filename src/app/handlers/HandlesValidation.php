<?php
namespace App\Handlers;

use Exception;

trait HandlesValidation
{
    private int $countableParameters = 2;

    /**
     * @throws Exception
     */
    private function prepareRules($rules): array
    {
        $rules = explode('|', $rules);
        foreach ($rules as &$rule) {
            if (strripos($rule, ':')) {
                $rule = explode(':', $rule);
                if (count($rule) > $this->countableParameters) {
                    throw new Exception('Only two parameters provided for this rule');
                }
            }
        }
        return $rules;
    }

    private function string($value): bool
    {
        return is_string($value);
    }

    private function integer($value): bool
    {
        return is_integer($value);
    }

    private function min($value, $minLength): bool
    {
        return strlen($value) >= $minLength;
    }

    private function max($value, $maxLength): bool
    {
        return strlen($value) <= $maxLength;
    }

    private function required($value): bool
    {
        return !empty($value);
    }
}