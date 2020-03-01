<?php

namespace CCA\LaravelValidations\Tests\Social;

use CCA\LaravelValidations\Social\VimeoPlayerURL;
use CCA\LaravelValidations\Tests\TestCase;

class VimeoPlayerURLTest extends TestCase
{
    /**
     * @test
     * @covers \CCA\LaravelValidations\Social\VimeoPlayerURL::passes
     */
    public function valid_links()
    {
        $rule = [
            'url' => [
                new VimeoPlayerURL(),
            ],
        ];

        $this->assertTrue(
            validator(
                ['url' => 'https://player.vimeo.com/video/197535359',],
                $rule
            )->passes()
        );
    }

    /**
     * @test
     * @covers \CCA\LaravelValidations\Social\VimeoPlayerURL::passes
     * @covers \CCA\LaravelValidations\Social\VimeoPlayerURL::message
     */
    public function invalid_link_only_vimeo_player()
    {
        $rule = [
            'url' => [
                new VimeoPlayerURL(),
            ],
        ];

        $result = validator(
            ['url' => 'https://player.vimeo.com',],
            $rule
        );
        $this->assertFalse($result->passes());
        $this->assertSame(
            'The url must be a valid Vimeo Player URL',
            $result->errors()->first()
        );
    }

    /**
     * @test
     * @covers \CCA\LaravelValidations\Social\VimeoPlayerURL::passes
     * @covers \CCA\LaravelValidations\Social\VimeoPlayerURL::message
     */
    public function invalid_link_not_player()
    {
        $rule = [
            'url' => [
                new VimeoPlayerURL(),
            ],
        ];

        $result = validator(
            ['url' => 'https://vimeo.com/thenarrative',],
            $rule
        );
        $this->assertFalse($result->passes());
        $this->assertSame(
            'The url must be a valid Vimeo Player URL',
            $result->errors()->first()
        );
    }

    /**
     * @test
     * @covers \CCA\LaravelValidations\Social\VimeoPlayerURL::passes
     * @covers \CCA\LaravelValidations\Social\VimeoPlayerURL::message
     */
    public function invalid_link_wrong_domain()
    {
        $rule = [
            'url' => [
                new VimeoPlayerURL(),
            ],
        ];

        $result = validator(
            ['url' => 'https://myspace.com/cca',],
            $rule
        );

        $this->assertFalse($result->passes());
        $this->assertSame(
            'The url must be a valid Vimeo Player URL',
            $result->errors()->first()
        );
    }
}
