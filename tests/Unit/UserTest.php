<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use App\User;

class UserTest extends TestCase
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

//    /** @test */
//    function a_user_has_group_projects()
//    {
//        $john = $this->signIn();
//
//        ProjectFactory::ownedBy($john)->create();
//
//        $this->assertCount(1, $john->groupProjects);
//
//        $sally = factory(User::class)->create();
//        $nick = factory(User::class)->create();
//
//        $project = tap(ProjectFactory::ownedBy($sally)->create())->invite($nick);
//
//        $this->assertCount(1, $john->groupProjects);
//
//        $project->invite($john);
//
//        $this->assertCount(2, $john->groupProjects);
//    }
}
