<?php

namespace CCA\LaravelValidations\Social;

use Illuminate\Contracts\Validation\Rule;

class FacebookURL implements Rule
{
    /** @var string */
    protected $attribute;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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

        preg_match_all(
            '/^(https:\/\/)(www\.)?(facebook\.com)\/?([\w\.]*)\/?$/',
            $value,
            $matches
        );

        if ($matches[4] == null) {
            return false;
        }

        if ($matches[4][0] === '') {
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
        return __('LaravelValidations::messages.social.facebook_url', [
            'attribute' => $this->attribute,
        ]);
    }
}
