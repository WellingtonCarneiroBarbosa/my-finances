<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Laravel\Jetstream\Features;
use Laravel\Jetstream\Http\Livewire\WorkspaceMemberManager;
use Laravel\Jetstream\Mail\WorkspaceInvitation;
use Livewire\Livewire;
use Tests\TestCase;

class InviteWorkspaceMemberTest extends TestCase
{
    use RefreshDatabase;

    public function test_workspace_members_can_be_invited_to_workspace(): void
    {
        if (! Features::sendsWorkspaceInvitations()) {
            $this->markTestSkipped('Workspace invitations not enabled.');

            return;
        }

        Mail::fake();

        $this->actingAs($user = User::factory()->withPersonalWorkspace()->create());

        $component = Livewire::test(WorkspaceMemberManager::class, ['workspace' => $user->currentWorkspace])
                        ->set('addWorkspaceMemberForm', [
                            'email' => 'test@example.com',
                            'role'  => 'admin',
                        ])->call('addWorkspaceMember');

        Mail::assertSent(WorkspaceInvitation::class);

        $this->assertCount(1, $user->currentWorkspace->fresh()->workspaceInvitations);
    }

    public function test_workspace_member_invitations_can_be_cancelled(): void
    {
        if (! Features::sendsWorkspaceInvitations()) {
            $this->markTestSkipped('Workspace invitations not enabled.');

            return;
        }

        Mail::fake();

        $this->actingAs($user = User::factory()->withPersonalWorkspace()->create());

        // Add the workspace member...
        $component = Livewire::test(WorkspaceMemberManager::class, ['workspace' => $user->currentWorkspace])
                        ->set('addWorkspaceMemberForm', [
                            'email' => 'test@example.com',
                            'role'  => 'admin',
                        ])->call('addWorkspaceMember');

        $invitationId = $user->currentWorkspace->fresh()->workspaceInvitations->first()->id;

        // Cancel the workspace invitation...
        $component->call('cancelWorkspaceInvitation', $invitationId);

        $this->assertCount(0, $user->currentWorkspace->fresh()->workspaceInvitations);
    }
}
