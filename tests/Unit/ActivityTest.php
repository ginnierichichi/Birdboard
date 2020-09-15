<?php

namespace Tests\Unit;

use App\Activity;
use App\User;
use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_user()
    {
        $user = $this->signIn();

        // $project = factory(Project::class)->create();
        $project = ProjectFactory::ownedBy($user)->create();

        // $this->assertInstanceOf(User::class, $project->activity->first()->user);

        $this->assertEquals($user->id, $project->activity->first()->user->id);
    }
}
