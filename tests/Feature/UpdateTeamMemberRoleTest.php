<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\WorkspaceMemberManager;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateWorkspaceMemberRoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_workspace_member_roles_can_be_updated(): void
    {
        $this->actingAs($user = User::factory()->withPersonalWorkspace()->create());

        $user->currentWorkspace->users()->attach(
            $otherUser = User::factory()->create(),
            ['role' => 'admin']
        );

        $component = Livewire::test(WorkspaceMemberManager::class, ['workspace' => $user->currentWorkspace])
                        ->set('managingRoleFor', $otherUser)
                        ->set('currentRole', 'editor')
                        ->call('updateRole');

        $this->assertTrue($otherUser->fresh()->hasWorkspaceRole(
            $user->currentWorkspace->fresh(),
            'editor'
        ));
    }

    public function test_only_workspace_owner_can_update_workspace_member_roles(): void
    {
        $user = User::factory()->withPersonalWorkspace()->create();

        $user->currentWorkspace->users()->attach(
            $otherUser = User::factory()->create(),
            ['role' => 'admin']
        );

        $this->actingAs($otherUser);

        $component = Livewire::test(WorkspaceMemberManager::class, ['workspace' => $user->currentWorkspace])
                        ->set('managingRoleFor', $otherUser)
                        ->set('currentRole', 'editor')
                        ->call('updateRole')
                        ->assertStatus(403);

        $this->assertTrue($otherUser->fresh()->hasWorkspaceRole(
            $user->currentWorkspace->fresh(),
            'admin'
        ));
    }
}
