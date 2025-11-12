<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LabelControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function testDisplaysLabelIndex(): void
    {
        Label::factory()->count(4)->create();

        $request = $this->get(route('labels.index'));

        $request->assertOk();
        $request->assertViewIs('labels.index');
    }

    public function testDispalysCreateForm(): void
    {
        $request = $this->get(route('labels.create'));

        $request->assertOk();
        $request->assertViewIs('labels.create');
    }

    public function testStoreNewLabel(): void
    {
        $request = $this->post(route('labels.store', [
            'name' => 'Test label',
        ]));

        $request->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', ['name' => 'Test label']);
    }

    public function testValidatesStoreRequest(): void
    {
        $request = $this->post(route('labels.store', []));

        $request->assertSessionHasErrors(['name']);
    }

    public function testDisplaysEditForm(): void
    {
        $label = Label::factory()->create();

        $request = $this->get(route('labels.edit', $label));

        $request->assertOk();
        $request->assertViewIs('labels.edit');
    }

    public function testUpdateLabel(): void
    {
        $label = Label::factory()->create(['name' => 'Test label']);

        $request = $this->put(route('labels.update', $label), [
            'name' => 'New lable name',
            'description' => 'New description',
        ]);

        $request->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', [
            'name' => 'New lable name',
            'description' => 'New description',
        ]);
    }

    public function testValidateUpdateRequest(): void
    {
        $label = Label::factory()->create();

        $request = $this->put(route('labels.update', $label), []);

        $request->assertSessionHasErrors('name');
    }

    public function testDeleteLabel(): void
    {
        $label = Label::factory()->create(['name' => 'Test label']);

        $request = $this->delete(route('labels.destroy', $label));

        $request->assertRedirect(route('labels.index'));
        $this->assertDatabaseMissing('labels', ['id' => $label->id, 'name' => 'Test label']);
    }
}
