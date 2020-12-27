<?php

namespace Tests\Feature;

use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function a_project_can_have_tasks()
    {
//        $this->withoutExceptionHandling();
        //        $this->actingAs(factory('App\User')->create());
        $this->signIn();    // alias for $this->actingAs(factory('App\User')->create());

//        $project = factory(Project::class)->raw();
//        $project = auth()->user()->projects()->create($project);

        $project = auth()->user()->projects()->create(
            factory(Project::class)->raw()
        );

/*        $project = factory(Project::class)->create(['owner_id' => auth()->id()]);
//        $this->post('/projects/id/tasks');*/

        $this->post($project->path() .'/tasks', ['body' => 'Test task']);
        $this->get($project->path())
            ->assertSee('Test task');
    }


    /**
     * @test
     * @return void
     */
    public function a_task_requires_a_body()
    {
        $this->signIn(); // create a new user and set him as authenticated

        $project = auth()->user()->projects()->create(
            factory(Project::class)->raw()
        );

        $attributes = factory('App\Task')->raw(['body' => '']);
        $this->post($project->path(). '/tasks', $attributes)->assertSessionHasErrors('body');
    }

}
