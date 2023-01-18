<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\CreateWorkspaceForm;
use Livewire\Livewire;
use Tests\TestCase;

class CreateWorkspaceTest extends TestCase
{
    use RefreshDatabase;

    public function test_workspaces_can_be_created(): void
    {
        $this->actingAs($user = User::factory()->withPersonalWorkspace()->create());

        Livewire::test(CreateWorkspaceForm::class)
                    ->set(['state' => ['name' => 'Test Workspace']])
                    ->call('createWorkspace');

        $this->assertCount(2, $user->fresh()->ownedWorkspaces);
        $this->assertEquals('Test Workspace', $user->fresh()->ownedWorkspaces()->latest('id')->first()->name);
    }
}
