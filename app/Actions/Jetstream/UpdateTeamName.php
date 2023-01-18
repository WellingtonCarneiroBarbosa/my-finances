<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\UpdatesWorkspaceNames;

class UpdateWorkspaceName implements UpdatesWorkspaceNames
{
    /**
     * Validate and update the given workspace's name.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, Workspace $workspace, array $input): void
    {
        Gate::forUser($user)->authorize('update', $workspace);

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
        ])->validateWithBag('updateWorkspaceName');

        $workspace->forceFill([
            'name' => $input['name'],
        ])->save();
    }
}
