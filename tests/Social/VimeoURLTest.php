<?php

namespace CCA\LaravelValidations\Tests\Social;

use CCA\LaravelValidations\Social\VimeoURL;
use CCA\LaravelValidations\Tests\TestCase;

class VimeoURLTest extends TestCase
{
    /**
     * @test
     * @covers \CCA\LaravelValidations\Social\VimeoURL::passes
     */
    public function valid_links()
    {
        $rule = [
            'url' => [
                new VimeoURL(),
            ],
        ];

        $this->assertTrue(
            validator(
                ['url' => 'https://www.vimeo.com/thenarrative/',],
                $rule
            )->passes()
        );

        $this->assertTrue(
            validator(
                ['url' => 'https://vimeo.com/thenarrative',],
                $rule
            )->passes()
        );
    }

    /**
     * @test
     * @covers \CCA\LaravelValidations\Social\VimeoURL::passes
     * @covers \CCA\LaravelValidations\Social\VimeoURL::message
     */
    public function invalid_link_only_vimeo()
    {
        $rule = [
            'url' => [
                new VimeoURL(),
            ],
        ];

        $result = validator(
            ['url' => 'https://vimeo.com/',],
            $rule
        );
        $this->assertFalse($result->passes());
        $this->assertSame(
            'The url must be a valid Vimeo URL',
            $result->errors()->first()
        );
    }

    /**
     * @test
     * @covers \CCA\LaravelValidations\Social\VimeoURL::passes
     * @covers \CCA\LaravelValidations\Social\VimeoURL::message
     */
    public function invalid_link_wrong_domain()
    {
        $rule = [
            'url' => [
                new VimeoURL(),
            ],
        ];

        $result = validator(
            ['url' => 'https://myspace.com/cca',],
            $rule
        );

        $this->assertFalse($result->passes());
        $this->assertSame(
            'The url must be a valid Vimeo URL',
            $result->errors()->first()
        );
    }
}
