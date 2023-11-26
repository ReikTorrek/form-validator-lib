<?php

namespace App\Helpers;

use Exception;

trait FunctionHelper
{
    protected string $functionPrefix = 'is_';

    private function makeFunctionName(string $ruleName): string
    {
        return $this->functionPrefix . $ruleName;
    }

    //Not the best solution I think, but I want to add min/max rule. And this is the best way I found.
    private function getFunctionNameFromCompositeRule(string $ruleName): string|bool
    {
        return strstr($ruleName, ':', true);
    }

    private function getParamFromCompositeRule(string $ruleName): string|bool
    {
        return substr(strstr($ruleName, ':'), 1);
    }

    /**
     * @throws Exception
     */
    private function callIfExists(string $functionName, mixed $param): mixed
    {
        if (function_exists($this->makeFunctionName($functionName))) {
            return call_user_func($this->makeFunctionName($functionName), $param);
        }
        if (method_exists($this, $functionName)) {
            return call_user_func([$this, $functionName], $param);
        }
        //Maybe I should wrap line here...
        if (method_exists($this, $this->getFunctionNameFromCompositeRule($functionName)) && $this->getParamFromCompositeRule($functionName)) {
            return call_user_func([$this, $this->getFunctionNameFromCompositeRule($functionName)], $param, $this->getParamFromCompositeRule($functionName));
        }
        throw new Exception('Method or function not exists');
    }

    /**
     * @throws Exception
     */
    //I can create additional helper for this type of functions, but still its only one, it can be here to avoid Over-engineering
    private function throwIf(string $message, bool $condition): void
    {
        if ($condition) {
            throw new Exception($message);
        }
    }
}