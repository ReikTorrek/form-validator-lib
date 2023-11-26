<?php
namespace App;

use App\Helpers\FunctionHelper;
use Exception;
use App\Handlers\HandlesValidation;


/**
 * <summary>
 * Validate array of data with rules.
 * </summary>
 *
 * <remarks>
 * you can check string, int/integer, bool, array, double etc. basic types
 * if you need to check field for required (not empty) use required
 * you can use composite rule names to validate min and max length of value. Use min:{integerNumber} or max:{integerNumber}
 * </remarks>
 */
class Form
{
    use HandlesValidation;
    use FunctionHelper;

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
                if (!$this->callIfExists($rule, $this->form[$name])) {
                    return false;
                }
            }
        }
        return true;
    }
}