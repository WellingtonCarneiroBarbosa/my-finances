<?php

namespace App\Actions\Jetstream;

use App\Models\Workspace;
use Laravel\Jetstream\Contracts\DeletesWorkspaces;

class DeleteWorkspace implements DeletesWorkspaces
{
    /**
     * Delete the given workspace.
     */
    public function delete(Workspace $workspace): void
    {
        $workspace->purge();
    }
}
