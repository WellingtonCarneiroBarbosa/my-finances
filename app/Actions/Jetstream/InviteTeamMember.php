<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use App\Models\Workspace;
use Closure;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\Contracts\InvitesWorkspaceMembers;
use Laravel\Jetstream\Events\InvitingWorkspaceMember;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\Mail\WorkspaceInvitation;
use Laravel\Jetstream\Rules\Role;

class InviteWorkspaceMember implements InvitesWorkspaceMembers
{
    /**
     * Invite a new workspace member to the given workspace.
     */
    public function invite(User $user, Workspace $workspace, string $email, string $role = null): void
    {
        Gate::forUser($user)->authorize('addWorkspaceMember', $workspace);

        $this->validate($workspace, $email, $role);

        InvitingWorkspaceMember::dispatch($workspace, $email, $role);

        $invitation = $workspace->workspaceInvitations()->create([
            'email' => $email,
            'role'  => $role,
        ]);

        Mail::to($email)->send(new WorkspaceInvitation($invitation));
    }

    /**
     * Validate the invite member operation.
     */
    protected function validate(Workspace $workspace, string $email, ?string $role): void
    {
        Validator::make([
            'email' => $email,
            'role'  => $role,
        ], $this->rules($workspace), [
            'email.unique' => __('This user has already been invited to the workspace.'),
        ])->after(
            $this->ensureUserIsNotAlreadyOnWorkspace($workspace, $email)
        )->validateWithBag('addWorkspaceMember');
    }

    /**
     * Get the validation rules for inviting a workspace member.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    protected function rules(Workspace $workspace): array
    {
        return array_filter([
            'email' => [
                'required', 'email',
                Rule::unique('workspace_invitations')->where(function (Builder $query) use ($workspace) {
                    $query->where('workspace_id', $workspace->id);
                }),
            ],
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
