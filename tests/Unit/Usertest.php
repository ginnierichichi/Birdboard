<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class Usertest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function a_user_has_projects()
    {
        $user = factory('App\Users')->create();
        $this->assertInstanceOf(Collection::class, $user->projects);
    }
}
