<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\UpdateWorkspaceNameForm;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateWorkspaceNameTest extends TestCase
{
    use RefreshDatabase;

    public function test_workspace_names_can_be_updated(): void
    {
        $this->actingAs($user = User::factory()->withPersonalWorkspace()->create());

        Livewire::test(UpdateWorkspaceNameForm::class, ['workspace' => $user->currentWorkspace])
                    ->set(['state' => ['name' => 'Test Workspace']])
                    ->call('updateWorkspaceName');

        $this->assertCount(1, $user->fresh()->ownedWorkspaces);
        $this->assertEquals('Test Workspace', $user->currentWorkspace->fresh()->name);
    }
}
