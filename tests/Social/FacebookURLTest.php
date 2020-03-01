<?php

namespace CCA\LaravelValidations\Tests\Social;

use CCA\LaravelValidations\Social\FacebookURL;
use CCA\LaravelValidations\Tests\TestCase;

class FacebookURLTest extends TestCase
{
    /**
     * @test
     * @covers \CCA\LaravelValidations\Social\FacebookURL::passes
     */
    public function valid_links()
    {
        $rule = [
            'url' => [
                new FacebookURL(),
            ],
        ];

        $this->assertTrue(
            validator(
                ['url' => 'https://www.facebook.com/castingcallsamerica',],
                $rule
            )->passes()
        );

        $this->assertTrue(
            validator(
                ['url' => 'https://facebook.com/castingcallsamerica',],
                $rule
            )->passes()
        );
    }

    /**
     * @test
     * @covers \CCA\LaravelValidations\Social\FacebookURL::passes
     * @covers \CCA\LaravelValidations\Social\FacebookURL::message
     */
    public function invalid_link_only_facebook()
    {
        $rule = [
            'url' => [
                new FacebookURL(),
            ],
        ];

        $result = validator(
            ['url' => 'https://facebook.com/',],
            $rule
        );
        $this->assertFalse($result->passes());
        $this->assertSame(
            'The url must be a valid Facebook URL',
            $result->errors()->first()
        );
    }

    /**
     * @test
     * @covers \CCA\LaravelValidations\Social\FacebookURL::passes
     * @covers \CCA\LaravelValidations\Social\FacebookURL::message
     */
    public function invalid_link_wrong_domain()
    {
        $rule = [
            'url' => [
                new FacebookURL(),
            ],
        ];

        $result = validator(
            ['url' => 'https://myspace.com/cca',],
            $rule
        );

        $this->assertFalse($result->passes());
        $this->assertSame(
            'The url must be a valid Facebook URL',
            $result->errors()->first()
        );
    }
}
