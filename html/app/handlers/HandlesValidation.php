<?php
namespace App\Handlers;

use Exception;
use App\Helpers\FunctionHelper;

trait HandlesValidation
{
    use FunctionHelper;

    private int $countableParameters = 2;

    /**
     * @throws Exception
     */
    private function prepareRules($rules): array
    {
        $rules = explode('|', $rules);
        foreach ($rules as $rule) {
            $this->throwIf('Rule can not be empty', $this->isEmptyRule($rule));
        }
        return $rules;
    }

    private function isEmptyRule($rule): bool
    {
        return empty($rule);
    }

    private function required($value): bool
    {
        return !empty($value);
    }

    private function min(string $value, int $length): bool
    {
        return strlen($value) >= $length;
    }

    private function max(string $value, int $length): bool
    {
        return strlen($value) <= $length;
    }
}