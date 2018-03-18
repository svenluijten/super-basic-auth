<?php

namespace Sven\SuperBasicAuth\Tests;

use Sven\SuperBasicAuth\SuperBasicAuth;

class SuperBasicAuthTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app['config']['auth.basic.user'] = 'test-admin';
        $app['config']['auth.basic.password'] = 'admin-password';

        $app['router']->get('/guest', function () {
            return 'guest';
        });

        $app['router']->get('/admin', function () {
            return 'admin';
        })->middleware(SuperBasicAuth::class);
    }

    /** @test */
    public function anyone_can_access_unprotected_routes()
    {
        $this->get('/guest')
            ->assertStatus(200);
    }

    /** @test */
    public function you_must_define_username_and_password()
    {
        $this->get('/admin')
            ->assertStatus(401)
            ->assertHeader('WWW-Authenticate', 'Basic');
    }

    /** @test */
    public function it_denies_entry_after_wrong_username_or_password_are_given()
    {
        $headers = [
            'PHP_AUTH_USER' => 'incorrect-username',
            'PHP_AUTH_PW' => 'wrong!',
        ];

        $this->get('/admin', $headers)
            ->assertStatus(401)
            ->assertHeader('WWW-Authenticate', 'Basic');
    }

    /** @test */
    public function it_authenticates_a_user_by_correct_username_and_password()
    {
        $headers = [
            'PHP_AUTH_USER' => 'test-admin',
            'PHP_AUTH_PW' => 'admin-password',
        ];

        $this->get('/admin', $headers)
            ->assertStatus(200)
            ->assertSee('admin');
    }

    /** @test */
    public function it_denies_entry_when_username_or_password_are_null()
    {
        app('config')->set('auth.basic.user', null);
        app('config')->set('auth.basic.password', null);

        $headers = [
            'PHP_AUTH_USER' => null,
            'PHP_AUTH_PW' => null,
        ];

        $this->get('/admin', $headers)
            ->assertStatus(401)
            ->assertHeader('WWW-Authenticate', 'Basic');
    }
}
