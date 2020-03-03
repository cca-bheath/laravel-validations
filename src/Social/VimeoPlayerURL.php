<?php

namespace CCA\LaravelValidations\Social;

use Illuminate\Contracts\Validation\Rule;

class VimeoPlayerURL implements Rule
{
    public const REGEX = '/^(https:\/\/)player.vimeo.com\/video\/[\w]+(\/)?$/';

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

        return (bool) preg_match(self::REGEX, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('LaravelValidations::messages.social.vimeo_player_url', [
            'attribute' => $this->attribute,
        ]);
    }
}
