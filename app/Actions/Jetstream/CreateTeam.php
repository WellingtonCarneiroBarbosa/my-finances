<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\CreatesWorkspaces;
use Laravel\Jetstream\Events\AddingWorkspace;
use Laravel\Jetstream\Jetstream;

class CreateWorkspace implements CreatesWorkspaces
{
    /**
     * Validate and create a new workspace for the given user.
     *
     * @param  array<string, string>  $input
     */
    public function create(User $user, array $input): Workspace
    {
        Gate::forUser($user)->authorize('create', Jetstream::newWorkspaceModel());

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
        ])->validateWithBag('createWorkspace');

        AddingWorkspace::dispatch($user);

        $user->switchWorkspace($workspace = $user->ownedWorkspaces()->create([
            'name'               => $input['name'],
            'personal_workspace' => false,
        ]));

        return $workspace;
    }
}
