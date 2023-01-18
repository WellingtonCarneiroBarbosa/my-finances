<?php

namespace App\Providers;

use App\Actions\Jetstream\AddWorkspaceMember;
use App\Actions\Jetstream\CreateWorkspace;
use App\Actions\Jetstream\DeleteUser;
use App\Actions\Jetstream\DeleteWorkspace;
use App\Actions\Jetstream\InviteWorkspaceMember;
use App\Actions\Jetstream\RemoveWorkspaceMember;
use App\Actions\Jetstream\UpdateWorkspaceName;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configurePermissions();

        Jetstream::createWorkspacesUsing(CreateWorkspace::class);
        Jetstream::updateWorkspaceNamesUsing(UpdateWorkspaceName::class);
        Jetstream::addWorkspaceMembersUsing(AddWorkspaceMember::class);
        Jetstream::inviteWorkspaceMembersUsing(InviteWorkspaceMember::class);
        Jetstream::removeWorkspaceMembersUsing(RemoveWorkspaceMember::class);
        Jetstream::deleteWorkspacesUsing(DeleteWorkspace::class);
        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the roles and permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::role('admin', 'Administrator', [
            'create',
            'read',
            'update',
            'delete',
        ])->description('Administrator users can perform any action.');

        Jetstream::role('editor', 'Editor', [
            'read',
            'create',
            'update',
        ])->description('Editor users have the ability to read, create, and update.');
    }
}
