<?php

namespace CCA\LaravelValidations\Tests\Social;

use CCA\LaravelValidations\Social\IMDBURL;
use CCA\LaravelValidations\Tests\TestCase;

class IMDBURLTest extends TestCase
{
    /**
     * @test
     * @covers \CCA\LaravelValidations\Social\IMDBURL::passes
     */
    public function valid_links()
    {
        $rule = [
            'url' => [
                new IMDBURL(),
            ],
        ];

        $this->assertTrue(
            validator(
                ['url' => 'https://www.imdb.com/name/nm0000134',],
                $rule
            )->passes()
        );

        $this->assertTrue(
            validator(
                ['url' => 'https://imdb.com/name/nm0000134/',],
                $rule
            )->passes()
        );
    }

    /**
     * @test
     * @covers \CCA\LaravelValidations\Social\IMDBURL::passes
     * @covers \CCA\LaravelValidations\Social\IMDBURL::message
     */
    public function invalid_link_only_imdb()
    {
        $rule = [
            'url' => [
                new IMDBURL(),
            ],
        ];

        $result = validator(
            ['url' => 'https://imdb.com/',],
            $rule
        );
        $this->assertFalse($result->passes());
        $this->assertSame(
            'The url must be a valid IMDB URL',
            $result->errors()->first()
        );
    }

    /**
     * @test
     * @covers \CCA\LaravelValidations\Social\IMDBURL::passes
     * @covers \CCA\LaravelValidations\Social\IMDBURL::message
     */
    public function invalid_link_wrong_domain()
    {
        $rule = [
            'url' => [
                new IMDBURL(),
            ],
        ];

        $result = validator(
            ['url' => 'https://myspace.com/cca',],
            $rule
        );

        $this->assertFalse($result->passes());
        $this->assertSame(
            'The url must be a valid IMDB URL',
            $result->errors()->first()
        );
    }
}
