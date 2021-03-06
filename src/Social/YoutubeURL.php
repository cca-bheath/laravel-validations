<?php

namespace CCA\LaravelValidations\Social;

use Illuminate\Contracts\Validation\Rule;

class YoutubeURL implements Rule
{
    public const REGEX = '/^(https:\/\/)(www\.)?(youtube\.com|youtu\.be)\/(watch\?v=|embed\/)?[\w]+(\?t=\d*)?(\/)?$/';

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
        return __('LaravelValidations::messages.social.youtube_url', [
            'attribute' => $this->attribute,
        ]);
    }
}
