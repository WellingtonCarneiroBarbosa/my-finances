<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\Contracts\DeletesUsers;
use Laravel\Jetstream\Contracts\DeletesWorkspaces;

class DeleteUser implements DeletesUsers
{
    /**
     * The workspace deleter implementation.
     *
     * @var \Laravel\Jetstream\Contracts\DeletesWorkspaces
     */
    protected $deletesWorkspaces;

    /**
     * Create a new action instance.
     */
    public function __construct(DeletesWorkspaces $deletesWorkspaces)
    {
        $this->deletesWorkspaces = $deletesWorkspaces;
    }

    /**
     * Delete the given user.
     */
    public function delete(User $user): void
    {
        DB::transaction(function () use ($user) {
            $this->deleteWorkspaces($user);
            $user->deleteProfilePhoto();
            $user->tokens->each->delete();
            $user->delete();
        });
    }

    /**
     * Delete the workspaces and workspace associations attached to the user.
     */
    protected function deleteWorkspaces(User $user): void
    {
        $user->workspaces()->detach();

        $user->ownedWorkspaces->each(function (Workspace $workspace) {
            $this->deletesWorkspaces->delete($workspace);
        });
    }
}
