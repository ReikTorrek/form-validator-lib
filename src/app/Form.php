<?php
namespace App;

use App\Handlers\HandlesValidation;
use Exception;

require_once 'handlers/HandlesValidation.php';

class Form
{
    use HandlesValidation;

    public array $form;

    public function __construct(array $array = [])
    {
        $this->form = $array;
    }

    /**
     * @throws Exception
     */
    public function validate(array $data): bool
    {
        foreach ($data as $name => $rules) {
            $rules = $this->prepareRules($rules);
            foreach ($rules as $rule) {
                if (!is_array($rule) && method_exists($this, $rule)) {
                    $result = call_user_func([$this, $rule], $this->form[$name]);
                } else {
                    $result = call_user_func([$this, $rule[0]], $this->form[$name], $rule[1]);
                }
                dump($result);
            }
        }
        return false;
    }
}