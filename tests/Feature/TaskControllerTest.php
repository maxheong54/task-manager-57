<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function testDisplaysTasksIndex(): void
    {
        Task::factory()->count(3)->create();

        $response = $this->get(route('tasks.index'));

        $response->assertOk();
        $response->assertViewIs('tasks.index');
    }

    public function testDisplaysCreateForm(): void
    {
        $response = $this->get(route('tasks.create'));

        $response->assertOk();
        $response->assertViewIs('tasks.create');
    }

    public function testStoreNewTask(): void
    {
        $status = TaskStatus::factory()->create();
        $response = $this->post(route('tasks.store', [
            'name' => 'Test task',
            'status_id' => $status->id,
        ]));

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', ['name' => 'Test task', 'status_id' => 1]);
    }

    public function testValidatesStoreRequest(): void
    {
        $response = $this->post(route('tasks.store', []));

        $response->assertSessionHasErrors(['name', 'status_id']);
    }

    public function testDisplaysEditForm(): void
    {
        $task = Task::factory()->create();
        $response = $this->get(route('tasks.edit', [$task]));

        $response->assertOk();
        $response->assertViewIs('tasks.edit');
    }

    public function testUpdateTask(): void
    {
        /** @var \App\Models\Task $task */
        $task = Task::factory()->create(['name' => 'Test task']);

        $response = $this->put(route('tasks.update', $task), [
            'name' => 'Updated test task',
            'status_id' => $task->status->id,
        ]);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'name' => 'Updated test task']);
    }

    public function testValidatesUpdateRequest(): void
    {
        $task = Task::factory()->create();
        $response = $this->put(route('tasks.update', $task), []);

        $response->assertSessionHasErrors('name', 'status_id');
    }

    public function testDeleteTask(): void
    {
        $task = Task::factory()->create();

        $response = $this->delete(route('tasks.destroy', $task));

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
