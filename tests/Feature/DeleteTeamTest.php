<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\DeleteWorkspaceForm;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteWorkspaceTest extends TestCase
{
    use RefreshDatabase;

    public function test_workspaces_can_be_deleted(): void
    {
        $this->actingAs($user = User::factory()->withPersonalWorkspace()->create());

        $user->ownedWorkspaces()->save($workspace = Workspace::factory()->make([
            'personal_workspace' => false,
        ]));

        $workspace->users()->attach(
            $otherUser = User::factory()->create(),
            ['role' => 'test-role']
        );

        $component = Livewire::test(DeleteWorkspaceForm::class, ['workspace' => $workspace->fresh()])
                                ->call('deleteWorkspace');

        $this->assertNull($workspace->fresh());
        $this->assertCount(0, $otherUser->fresh()->workspaces);
    }

    public function test_personal_workspaces_cant_be_deleted(): void
    {
        $this->actingAs($user = User::factory()->withPersonalWorkspace()->create());

        $component = Livewire::test(DeleteWorkspaceForm::class, ['workspace' => $user->currentWorkspace])
                                ->call('deleteWorkspace')
                                ->assertHasErrors(['workspace']);

        $this->assertNotNull($user->currentWorkspace->fresh());
    }
}
