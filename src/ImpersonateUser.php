<?php

namespace CCA\LaravelValidations;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ImpersonateUser implements Rule
{
    /** @var string */
    protected $attribute;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

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

        if (! $this->user::find($value)) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('LaravelValidations::messages.user.impersonation', [
            'attribute' => $this->attribute,
        ]);
    }
}
