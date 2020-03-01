<?php

namespace CCA\LaravelValidations\Social;

use Illuminate\Contracts\Validation\Rule;

class InstagramURL implements Rule
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

        return (bool) preg_match('/^(?:https:\/\/)(www\.)?instagram.com\/[\w]+(\/)?$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('LaravelValidations::messages.social.instagram_url', [
            'attribute' => $this->attribute,
        ]);
    }
}
