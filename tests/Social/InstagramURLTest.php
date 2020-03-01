<?php

namespace CCA\LaravelValidations\Tests\Social;

use CCA\LaravelValidations\Social\InstagramURL;
use CCA\LaravelValidations\Tests\TestCase;

class InstagramURLTest extends TestCase
{
    /**
     * @test
     * @covers \CCA\LaravelValidations\Social\InstagramURL::passes
     */
    public function valid_links()
    {
        $rule = [
            'url' => [
                new InstagramURL(),
            ],
        ];

        $this->assertTrue(
            validator(
                ['url' => 'https://www.instagram.com/castingamerica/',],
                $rule
            )->passes()
        );

        $this->assertTrue(
            validator(
                ['url' => 'https://instagram.com/castingamerica',],
                $rule
            )->passes()
        );
    }

    /**
     * @test
     * @covers \CCA\LaravelValidations\Social\InstagramURL::passes
     * @covers \CCA\LaravelValidations\Social\InstagramURL::message
     */
    public function invalid_link_only_instagram()
    {
        $rule = [
            'url' => [
                new InstagramURL(),
            ],
        ];

        $result = validator(
            ['url' => 'https://instagram.com/',],
            $rule
        );
        $this->assertFalse($result->passes());
        $this->assertSame(
            'The url must be a valid Instagram URL',
            $result->errors()->first()
        );
    }

    /**
     * @test
     * @covers \CCA\LaravelValidations\Social\InstagramURL::passes
     * @covers \CCA\LaravelValidations\Social\InstagramURL::message
     */
    public function invalid_link_wrong_domain()
    {
        $rule = [
            'url' => [
                new InstagramURL(),
            ],
        ];

        $result = validator(
            ['url' => 'https://myspace.com/cca',],
            $rule
        );

        $this->assertFalse($result->passes());
        $this->assertSame(
            'The url must be a valid Instagram URL',
            $result->errors()->first()
        );
    }
}
