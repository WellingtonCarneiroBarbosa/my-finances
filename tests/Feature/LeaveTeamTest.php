<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\WorkspaceMemberManager;
use Livewire\Livewire;
use Tests\TestCase;

class LeaveWorkspaceTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_leave_workspaces(): void
    {
        $user = User::factory()->withPersonalWorkspace()->create();

        $user->currentWorkspace->users()->attach(
            $otherUser = User::factory()->create(),
            ['role' => 'admin']
        );

        $this->actingAs($otherUser);

        $component = Livewire::test(WorkspaceMemberManager::class, ['workspace' => $user->currentWorkspace])
                        ->call('leaveWorkspace');

        $this->assertCount(0, $user->currentWorkspace->fresh()->users);
    }

    public function test_workspace_owners_cant_leave_their_own_workspace(): void
    {
        $this->actingAs($user = User::factory()->withPersonalWorkspace()->create());

        $component = Livewire::test(WorkspaceMemberManager::class, ['workspace' => $user->currentWorkspace])
                        ->call('leaveWorkspace')
                        ->assertHasErrors(['workspace']);

        $this->assertNotNull($user->currentWorkspace->fresh());
    }
}
