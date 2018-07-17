<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;

    public $user;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        Artisan::call('db:seed');

        $this->user = User::create([
            'name' => 'me',
            'email' => 'me@mail.de',
            'password' => 'me'
        ]);
    }
}
