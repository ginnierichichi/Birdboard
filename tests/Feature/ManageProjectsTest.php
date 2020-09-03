<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
/** @test */
class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /** @test */
    public function guests_cannot_manage_projects()
    {
        //this->withoutExceptionHandling();
        $project = factory('App\Project')->create();

        $this->get('/projects')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');

    }

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(factory('App\User')->create());

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,

        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }



    /** @test */
    public function a_user_can_view_their_project()
    {
        $this->be(factory('App\User')->create());
        $this->withoutExceptionHandling(); //disables laravels exception handling
        $project = factory ('App\Project')->create(['owner_id'=>auth()->id()]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }


    /** @test */
    public function a_user_cannot_view_the_projects_of_others()
    {
        $this->be(factory('App\User')->create());
        //$this->withoutExceptionHandling(); //disables laravels exception handling
        $project = factory ('App\Project')->create();
        $this->get($project->path())->assertStatus(403);

    }

    /** @test */
    public function a_project_requires_a_title() //user needs to be signed in.
    {
        $this->actingAs(factory('App\User')->create());
        $attributes = factory('App\Project')->raw(['title'=> '']);

        $this->post('/projects', $attributes)->assertSessionhasErrors('title');
    }


    /** @test */
    public function a_project_requires_a_description()
    {
        $this->actingAs(factory('App\User')->create());
        $attributes = factory('App\Project')->raw(['title'=> '', 'description'=> '']);
        $this->post('/projects', $attributes)->assertSessionhasErrors('description');
    }

}

