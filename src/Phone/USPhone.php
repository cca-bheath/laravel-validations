<?php

namespace CCA\LaravelValidations\Phone;

use Illuminate\Contracts\Validation\Rule;

class USPhone implements Rule
{
    /** @var string */
    protected $attribute;

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->attribute = $attribute;

        $stripedOne = ltrim($value, '1');
        $striped    = preg_replace("/[^0-9]/", "", $stripedOne);

        return (strlen($striped) === 10);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('LaravelValidations::messages.phone.us', [
            'attribute' => $this->attribute,
        ]);
    }
}
