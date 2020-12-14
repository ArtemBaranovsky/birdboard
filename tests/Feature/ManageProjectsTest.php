<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test
     * 3 tests merged in 1
     */
    public function guests_cannot_manage_projects()
    {
        $project = factory('App\Project')->create();
        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');
    }

//    public function a_project_requires_an_owner()
//    public function only_authenticated_users_can_create_projects()
/*    public function guests_cannot_create_projects()
    {
//        $this->withoutExceptionHandling();
//        $attributes = factory('App\Project')->raw();    // falls if an owner wasn't specified
//        $this->post('/projects', $attributes)->assertSessionHasErrors('owner');

//        $attributes = factory('App\Project')->raw(['owner_id' => null]);
//        $this->post('/projects', $attributes)->assertSessionHasErrors('owner_id');

//        $attributes = factory('App\Project')->raw();
        $project = factory('App\Project')->create();
        $this->post('/projects', $project->toArray())->assertRedirect('login');
    }*/


//    public function only_authenticated_users_can_view_projects()
/*    public function guests_cannot_view_projects()
    {
        $this->get('/projects')->assertRedirect('login');
    }*/

/*    public function guests_cannot_view_a_single_project()
    {
        $project  = factory('App\Project')->create();
		$this->get($project->path())->assertRedirect('login');
    }*/

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->signIn();    // alias for $this->actingAs(factory('App\User')->create());
//        $this->actingAs(factory('App\User')->create()); // create a new user and set him as authenticated
        $this->withoutExceptionHandling();

        $this->get('/projects/create')->assertStatus(200);  // at the very least I expect that to be a page that loads

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];
        $this->post('/projects', $attributes)->assertRedirect('/projects');
        $this->assertDatabaseHas('projects', $attributes);
        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    public function a_project_requires_a_title()
    {
        $this->signIn(); // create a new user and set him as authenticated
        $attributes = factory('App\Project')->raw(['title' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $this->signIn(); // create a new user and set him as authenticated
        $attributes = factory('App\Project')->raw(['description' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }


    /** @test **/
//    public function a_user_can_view_a_project()
    public function a_user_can_view_their_project()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
//        $this->be(factory('App\User')->create());
//        $project = factory('App\Project')->create();
        $project = factory('App\Project')->create(['owner_id' => auth()->id()]);
//        $this->get('/projects/' . $project->id)
//        $this->get('/projects/' . $project->slug)
                $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test **/
    public function an_authenticated_user_cannot_view_the_projects_of_others()
    {
        $this->be(factory('App\User')->create());
//        $this->withoutExceptionHandling();
        $project = factory('App\Project')->create();
        $this->get($project->path())->assertStatus(403);
    }
}
