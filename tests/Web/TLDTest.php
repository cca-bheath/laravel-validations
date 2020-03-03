<?php

namespace CCA\LaravelValidations\Tests\Web;

use CCA\LaravelValidations\Web\TLD;
use CCA\LaravelValidations\Tests\TestCase;

class TLDTest extends TestCase
{
    /**
     * @test
     * @covers \CCA\LaravelValidations\Web\TLD::passes
     */
    public function valid_links()
    {
        $rule = [
            'url' => [
                new TLD(),
            ],
        ];

        $this->assertTrue(
            validator(
                ['url' => 'https://www.facebook.com',],
                $rule
            )->passes()
        );

        $this->assertTrue(
            validator(
                ['url' => 'https://movie.youtube',],
                $rule
            )->passes()
        );

        $this->assertTrue(
            validator(
                ['url' => 'https://staysin.vegas',],
                $rule
            )->passes()
        );
    }

    /**
     * @test
     * @covers \CCA\LaravelValidations\Web\TLD::passes
     * @covers \CCA\LaravelValidations\Web\TLD::message
     */
    public function invalid_TLD()
    {
        $rule = [
            'url' => [
                new TLD(),
            ],
        ];

        $result = validator(
            ['url' => 'https://facebook.fake/',],
            $rule
        );
        $this->assertFalse($result->passes());
        $this->assertSame(
            'The url must have a valid TLD',
            $result->errors()->first()
        );
    }

    /**
     * @test
     * @covers \CCA\LaravelValidations\Web\TLD::passes
     * @covers \CCA\LaravelValidations\Web\TLD::message
     */
    public function invalid_TLD_only_a_valid_TLD()
    {
        $rule = [
            'url' => [
                new TLD(),
            ],
        ];

        $result = validator(
            ['url' => 'https://youtube',],
            $rule
        );

        $this->assertFalse($result->passes());
        $this->assertSame(
            'The url must have a valid TLD',
            $result->errors()->first()
        );
    }
}
