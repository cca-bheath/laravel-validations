<?php

namespace CCA\LaravelValidations\Tests\Social;

use CCA\LaravelValidations\Social\YoutubeURL;
use CCA\LaravelValidations\Tests\TestCase;

class YoutubeURLTest extends TestCase
{
    /**
     * @test
     * @covers \CCA\LaravelValidations\Social\YoutubeURL::passes
     */
    public function valid_links()
    {
        $rule = [
            'url' => [
                new YoutubeURL(),
            ],
        ];

        $this->assertTrue(
            validator(
                ['url' => 'https://www.youtube.com/watch?v=C0DPdy98e4c',],
                $rule
            )->passes()
        );

        $this->assertTrue(
            validator(
                ['url' => 'https://youtube.com/embed/C0DPdy98e4c',],
                $rule
            )->passes()
        );
        $this->assertTrue(
            validator(
                ['url' => 'https://youtu.be/G8S81CEBdNs',],
                $rule
            )->passes()
        );

        $this->assertTrue(
            validator(
                ['url' => 'https://youtu.be/G8S81CEBdNs?t=50',],
                $rule
            )->passes()
        );
    }

    /**
     * @test
     * @covers \CCA\LaravelValidations\Social\YoutubeURL::passes
     * @covers \CCA\LaravelValidations\Social\YoutubeURL::message
     */
    public function invalid_link_only_youtube()
    {
        $rule = [
            'url' => [
                new YoutubeURL(),
            ],
        ];

        $result = validator(
            ['url' => 'https://youtube.com/',],
            $rule
        );
        $this->assertFalse($result->passes());
        $this->assertSame(
            'The url must be a valid Youtube URL',
            $result->errors()->first()
        );

        $result = validator(
            ['url' => 'https://youtu.be',],
            $rule
        );
        $this->assertFalse($result->passes());
        $this->assertSame(
            'The url must be a valid Youtube URL',
            $result->errors()->first()
        );
    }

    /**
     * @test
     * @covers \CCA\LaravelValidations\Social\YoutubeURL::passes
     * @covers \CCA\LaravelValidations\Social\YoutubeURL::message
     */
    public function invalid_link_wrong_domain()
    {
        $rule = [
            'url' => [
                new YoutubeURL(),
            ],
        ];

        $result = validator(
            ['url' => 'https://myspace.com/cca',],
            $rule
        );

        $this->assertFalse($result->passes());
        $this->assertSame(
            'The url must be a valid Youtube URL',
            $result->errors()->first()
        );
    }
}
