<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PhpParser\Lexer\TokenEmulator\VoidCastEmulator;
use Tests\TestCase;

class TaskStatusControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function testDisplaysTaskStatusesIndex(): void
    {
        TaskStatus::factory()->count(2)->create();

        $response = $this->get(route('task_statuses.index'));

        $response->assertOk();
        $response->assertViewIs('task_statuses.index');
        $response->assertViewHas('taskStatuses');
    }

    public function testDisplaysCreateForm(): void
    {
        $response = $this->get(route('task_statuses.create'));

        $response->assertOk();
        $response->assertViewIs('task_statuses.create');
    }

    public function testStoreNewTaskStatus(): void
    {
        $response = $this->post(route('task_statuses.store', [
            'name' => 'New Status'
        ]));

        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', ['name' => 'New Status']);
    }

    public function testValidatesStoreRequest(): void
    {
        $response = $this->post(route('task_statuses.store', []));

        $response->assertSessionHasErrors('name');
    }

    public function testDisplaysEditForm(): void
    {
        $status = TaskStatus::factory()->create();

        $response = $this->get(route('task_statuses.edit', [$status]));

        $response->assertOk();
        $response->assertViewIs('task_statuses.edit');
        $response->assertViewHas('taskStatus', $status);
    }

    public function testUpdatesTaskStatus(): void
    {
        $status = TaskStatus::factory()->create(['name' => 'Old status name']);

        $response = $this->put(route('task_statuses.update', $status), [
            'name' => 'Updated status name',
        ]);

        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', ['id' => $status->id, 'name' => 'Updated status name']);
    }

    public function testValidateUpdateRequest(): void
    {
        $status = TaskStatus::factory()->create();

        $response = $this->put(route('task_statuses.update', $status), []);

        $response->assertSessionHasErrors('name');
    }

    public function testDeletesTaskStatus(): void
    {
        $status = TaskStatus::factory()->create();

        $response = $this->delete(route('task_statuses.destroy', $status));

        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseMissing('task_statuses', ['id' => $status->id]);
    }
}
