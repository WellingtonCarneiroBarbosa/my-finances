<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\WorkspaceMemberManager;
use Livewire\Livewire;
use Tests\TestCase;

class RemoveWorkspaceMemberTest extends TestCase
{
    use RefreshDatabase;

    public function test_workspace_members_can_be_removed_from_workspaces(): void
    {
        $this->actingAs($user = User::factory()->withPersonalWorkspace()->create());

        $user->currentWorkspace->users()->attach(
            $otherUser = User::factory()->create(),
            ['role' => 'admin']
        );

        $component = Livewire::test(WorkspaceMemberManager::class, ['workspace' => $user->currentWorkspace])
                        ->set('workspaceMemberIdBeingRemoved', $otherUser->id)
                        ->call('removeWorkspaceMember');

        $this->assertCount(0, $user->currentWorkspace->fresh()->users);
    }

    public function test_only_workspace_owner_can_remove_workspace_members(): void
    {
        $user = User::factory()->withPersonalWorkspace()->create();

        $user->currentWorkspace->users()->attach(
            $otherUser = User::factory()->create(),
            ['role' => 'admin']
        );

        $this->actingAs($otherUser);

        $component = Livewire::test(WorkspaceMemberManager::class, ['workspace' => $user->currentWorkspace])
                        ->set('workspaceMemberIdBeingRemoved', $user->id)
                        ->call('removeWorkspaceMember')
                        ->assertStatus(403);
    }
}
