<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use App\Models\Workspace;
use Closure;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\AddsWorkspaceMembers;
use Laravel\Jetstream\Events\AddingWorkspaceMember;
use Laravel\Jetstream\Events\WorkspaceMemberAdded;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\Rules\Role;

class AddWorkspaceMember implements AddsWorkspaceMembers
{
    /**
     * Add a new workspace member to the given workspace.
     */
    public function add(User $user, Workspace $workspace, string $email, string $role = null): void
    {
        Gate::forUser($user)->authorize('addWorkspaceMember', $workspace);

        $this->validate($workspace, $email, $role);

        $newWorkspaceMember = Jetstream::findUserByEmailOrFail($email);

        AddingWorkspaceMember::dispatch($workspace, $newWorkspaceMember);

        $workspace->users()->attach(
            $newWorkspaceMember,
            ['role' => $role]
        );

        WorkspaceMemberAdded::dispatch($workspace, $newWorkspaceMember);
    }

    /**
     * Validate the add member operation.
     */
    protected function validate(Workspace $workspace, string $email, ?string $role): void
    {
        Validator::make([
            'email' => $email,
            'role'  => $role,
        ], $this->rules(), [
            'email.exists' => __('We were unable to find a registered user with this email address.'),
        ])->after(
            $this->ensureUserIsNotAlreadyOnWorkspace($workspace, $email)
        )->validateWithBag('addWorkspaceMember');
    }

    /**
     * Get the validation rules for adding a workspace member.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    protected function rules(): array
    {
        return array_filter([
            'email' => ['required', 'email', 'exists:users'],
            'role'  => Jetstream::hasRoles()
                            ? ['required', 'string', new Role()]
                            : null,
        ]);
    }

    /**
     * Ensure that the user is not already on the workspace.
     */
    protected function ensureUserIsNotAlreadyOnWorkspace(Workspace $workspace, string $email): Closure
    {
        return function ($validator) use ($workspace, $email) {
            $validator->errors()->addIf(
                $workspace->hasUserWithEmail($email),
                'email',
                __('This user already belongs to the workspace.')
            );
        };
    }
}
