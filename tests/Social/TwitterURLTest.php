<?php

namespace CCA\LaravelValidations\Tests\Social;

use CCA\LaravelValidations\Social\TwitterURL;
use CCA\LaravelValidations\Tests\TestCase;

class TwitterURLTest extends TestCase
{
    /**
     * @test
     * @covers \CCA\LaravelValidations\Social\TwitterURL::passes
     */
    public function valid_links()
    {
        $rule = [
            'url' => [
                new TwitterURL(),
            ],
        ];

        $this->assertTrue(
            validator(
                ['url' => 'https://www.twitter.com/castingamerica/',],
                $rule
            )->passes()
        );

        $this->assertTrue(
            validator(
                ['url' => 'https://twitter.com/castingamerica',],
                $rule
            )->passes()
        );
    }

    /**
     * @test
     * @covers \CCA\LaravelValidations\Social\TwitterURL::passes
     * @covers \CCA\LaravelValidations\Social\TwitterURL::message
     */
    public function invalid_link_only_twitter()
    {
        $rule = [
            'url' => [
                new TwitterURL(),
            ],
        ];

        $result = validator(
            ['url' => 'https://instagram.com/',],
            $rule
        );
        $this->assertFalse($result->passes());
        $this->assertSame(
            'The url must be a valid Twitter URL',
            $result->errors()->first()
        );
    }

    /**
     * @test
     * @covers \CCA\LaravelValidations\Social\TwitterURL::passes
     * @covers \CCA\LaravelValidations\Social\TwitterURL::message
     */
    public function invalid_link_wrong_domain()
    {
        $rule = [
            'url' => [
                new TwitterURL(),
            ],
        ];

        $result = validator(
            ['url' => 'https://myspace.com/cca',],
            $rule
        );

        $this->assertFalse($result->passes());
        $this->assertSame(
            'The url must be a valid Twitter URL',
            $result->errors()->first()
        );
    }
}
