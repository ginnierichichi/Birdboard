<?php

namespace Tests\Feature;

use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function guests_cannot_add_tasks_to_projects()
    {
        $project = factory('App\Project')->create();
        $this->post($project->path() . '/tasks')->assertRedirect('login');
    }

    /** @test */
    function only_the_owner_of_a_project_may_add_tasks()
    {
        $this->signIn();

        $project= ProjectFactory::withTasks(1)->create();

        $this->patch($project->tasks[0]->path(), ['body' => 'Test Task'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
    }

    /** @test */
    function only_the_owner_of_a_project_may_update_tasks()
    {
        $this->signIn();
        $project = factory('App\Project')->create();

        $task = $project->addTask('test task');
        $this->patch($project->path() . '/tasks' . $task->id, ['body' => 'changed'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
    }


    /** @test */
    public function a_project_can_have_tasks()      //this is the feature test - comes from outside in
    {
        /* $this->withoutExceptionHandling();

        $this->signIn();

        $project = auth()->user()->projects()->create(      //create eloquent model
            factory(Project::class)->raw()
        ); */

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', ['body' => 'Test Task']);

        $this->get($project->path())
            ->assertSee('Test Task');
    }

    /** @test */
    function a_task_can_be_updated()
    {
        $project = ProjectFactory::withTasks(1)->create();

       /* $project = auth()->user()->projects()->create(      //create eloquent model
            factory(Project::class)->raw()
        );

        $task = $project->addTask('test task'); */

        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(), [
            'body' => 'changed',
            'completed'=> true
            ]);

        $this->assertDatabaseHas('tasks', [
            'body'=>'changed',
            'completed'=>true
            ]);
    }

    public function a_task_requires_a_body()
    {
       /* $this->signIn();

        $project = auth()->user()->projects()->create(      //create eloquent model
            factory(Project::class)->raw()
        ); */

        $project = ProjectFactory::create();

        $attributes = factory('App\Task')->raw(['body' => '']);

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
    }
}
