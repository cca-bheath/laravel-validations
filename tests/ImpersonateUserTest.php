<?php

namespace CCA\LaravelValidations\Tests;

use CCA\LaravelValidations\ImpersonateUser;
use CCA\LaravelValidations\Tests\TestCase;
use Illuminate\Foundation\Auth\User;

class ImpersonateUserTest extends TestCase
{
    /**
     * @test
     * @covers \CCA\LaravelValidations\ImpersonateUser::passes
     */
    public function returns_true_user_to_impersonate_exist()
    {
        factory(User::class)->create(['id' => 1]);
        
        $rule = [
            'user' => [
                new ImpersonateUser(User::class),
            ],
        ];

        $this->assertTrue(
            validator(
                ['user' => 1],
                $rule
            )->passes()
        );
    }

    /**
     * @test
     * @covers \CCA\LaravelValidations\ImpersonateUser::passes
     * *@covers \CCA\LaravelValidations\ImpersonateUser::message
     */
    public function returns_false_and_message_when_user_to_impersonate_does_not_exist()
    {
        factory(User::class)->create(['id' => 1]);

        $rule = [
            'user' => [
                new ImpersonateUser(User::class),
            ],
        ];

        $result = validator(
            ['user' => 2],
            $rule
        );
        $this->assertFalse($result->passes());
        $this->assertSame(
            "The user you are impersonating doesn't exist",
            $result->errors()->first()
        );
    }
}
