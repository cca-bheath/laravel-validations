<?php

namespace CCA\LaravelValidations\Tests\Phone;

use CCA\LaravelValidations\Phone\USPhone;
use CCA\LaravelValidations\Tests\TestCase;

class USPhoneTest extends TestCase
{
    /**
     * @test
     * @covers \CCA\LaravelValidations\Phone\USPhone::passes
     */
    public function valid_us_phone()
    {
        $rule = [
            'phone' => [
                new USPhone(),
            ],
        ];

        $this->assertTrue(
            validator(
                ['phone' => '1 202 555 0165',],
                $rule
            )->passes()
        );

        $this->assertTrue(
            validator(
                ['phone' => '1-202-555-0165',],
                $rule
            )->passes()
        );

        $this->assertTrue(
            validator(
                ['phone' => '202-555-0165',],
                $rule
            )->passes()
        );

        $this->assertTrue(
            validator(
                ['phone' => '202-555-0165-some-string',],
                $rule
            )->passes()
        );

        $this->assertTrue(
            validator(
                ['phone' => '12085550165',],
                $rule
            )->passes()
        );

        $this->assertTrue(
            validator(
                ['phone' => '12085550165somestring',],
                $rule
            )->passes()
        );
    }

    /**
     * @test
     * @covers \CCA\LaravelValidations\Phone\USPhone::passes
     * @covers \CCA\LaravelValidations\Phone\USPhone::message
     */
    public function invalid_phone_number()
    {
        $rule = [
            'phone' => [
                new USPhone(),
            ],
        ];

        $result = validator(
            ['phone' => 'some-string',],
            $rule
        );
        $this->assertFalse($result->passes());
        $this->assertSame(
            'The phone must be a valid US cell phone number',
            $result->errors()->first()
        );

        $result = validator(
            ['phone' => '1-208-444-01657',],
            $rule
        );
        $this->assertFalse($result->passes());
        $this->assertSame(
            'The phone must be a valid US cell phone number',
            $result->errors()->first()
        );
    }
}
