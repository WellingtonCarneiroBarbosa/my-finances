<div>
    @if (Gate::check('addWorkspaceMember', $workspace))
        <x-jet-section-border />

        <!-- Add Workspace Member -->
        <div class="mt-10 sm:mt-0">
            <x-jet-form-section submit="addWorkspaceMember">
                <x-slot name="title">
                    {{ __('Add Workspace Member') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Add a new workspace member to your workspace, allowing them to collaborate with you.') }}
                </x-slot>

                <x-slot name="form">
                    <div class="col-span-6">
                        <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Please provide the email address of the person you would like to add to this workspace.') }}
                        </div>
                    </div>

                    <!-- Member Email -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" type="email" class="mt-1 block w-full"
                            wire:model.defer="addWorkspaceMemberForm.email" />
                        <x-jet-input-error for="email" class="mt-2" />
                    </div>

                    <!-- Role -->
                    @if (count($this->roles) > 0)
                        <div class="col-span-6 lg:col-span-4">
                            <x-jet-label for="role" value="{{ __('Role') }}" />
                            <x-jet-input-error for="role" class="mt-2" />

                            <div
                                class="relative z-0 mt-1 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer">
                                @foreach ($this->roles as $index => $role)
                                    <button type="button"
                                        class="relative px-4 py-3 inline-flex w-full rounded-lg focus:z-10 focus:outline-none focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-600 {{ $index > 0 ? 'border-t border-gray-200 dark:border-gray-700 focus:border-none rounded-t-none' : '' }} {{ !$loop->last ? 'rounded-b-none' : '' }}"
                                        wire:click="$set('addWorkspaceMemberForm.role', '{{ $role->key }}')">
                                        <div
                                            class="{{ isset($addWorkspaceMemberForm['role']) && $addWorkspaceMemberForm['role'] !== $role->key ? 'opacity-50' : '' }}">
                                            <!-- Role Name -->
                                            <div class="flex items-center">
                                                <div
                                                    class="text-sm text-gray-600 dark:text-gray-400 {{ $addWorkspaceMemberForm['role'] == $role->key ? 'font-semibold' : '' }}">
                                                    {{ $role->name }}
                                                </div>

                                                @if ($addWorkspaceMemberForm['role'] == $role->key)
                                                    <svg class="ml-2 h-5 w-5 text-green-400"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                @endif
                                            </div>

                                            <!-- Role Description -->
                                            <div class="mt-2 text-xs text-gray-600 dark:text-gray-400 text-left">
                                                {{ $role->description }}
                                            </div>
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </x-slot>

                <x-slot name="actions">
                    <x-jet-action-message class="mr-3" on="saved">
                        {{ __('Added.') }}
                    </x-jet-action-message>

                    <x-jet-button>
                        {{ __('Add') }}
                    </x-jet-button>
                </x-slot>
            </x-jet-form-section>
        </div>
    @endif

    @if ($workspace->workspaceInvitations->isNotEmpty() && Gate::check('addWorkspaceMember', $workspace))
        <x-jet-section-border />

        <!-- Workspace Member Invitations -->
        <div class="mt-10 sm:mt-0">
            <x-jet-action-section>
                <x-slot name="title">
                    {{ __('Pending Workspace Invitations') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('These people have been invited to your workspace and have been sent an invitation email. They may join the workspace by accepting the email invitation.') }}
                </x-slot>

                <x-slot name="content">
                    <div class="space-y-6">
                        @foreach ($workspace->workspaceInvitations as $invitation)
                            <div class="flex items-center justify-between">
                                <div class="text-gray-600 dark:text-gray-400">{{ $invitation->email }}</div>

                                <div class="flex items-center">
                                    @if (Gate::check('removeWorkspaceMember', $workspace))
                                        <!-- Cancel Workspace Invitation -->
                                        <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none"
                                            wire:click="cancelWorkspaceInvitation({{ $invitation->id }})">
                                            {{ __('Cancel') }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-slot>
            </x-jet-action-section>
        </div>
    @endif

    @if ($workspace->users->isNotEmpty())
        <x-jet-section-border />

        <!-- Manage Workspace Members -->
        <div class="mt-10 sm:mt-0">
            <x-jet-action-section>
                <x-slot name="title">
                    {{ __('Workspace Members') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('All of the people that are part of this workspace.') }}
                </x-slot>

                <!-- Workspace Member List -->
                <x-slot name="content">
                    <div class="space-y-6">
                        @foreach ($workspace->users->sortBy('name') as $user)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <img class="w-8 h-8 rounded-full" src="{{ $user->profile_photo_url }}"
                                        alt="{{ $user->name }}">
                                    <div class="ml-4 dark:text-white">{{ $user->name }}</div>
                                </div>

                                <div class="flex items-center">
                                    <!-- Manage Workspace Member Role -->
                                    @if (Gate::check('addWorkspaceMember', $workspace) && Laravel\Jetstream\Jetstream::hasRoles())
                                        <button class="ml-2 text-sm text-gray-400 underline"
                                            wire:click="manageRole('{{ $user->id }}')">
                                            {{ Laravel\Jetstream\Jetstream::findRole($user->membership->role)->name }}
                                        </button>
                                    @elseif (Laravel\Jetstream\Jetstream::hasRoles())
                                        <div class="ml-2 text-sm text-gray-400">
                                            {{ Laravel\Jetstream\Jetstream::findRole($user->membership->role)->name }}
                                        </div>
                                    @endif

                                    <!-- Leave Workspace -->
                                    @if ($this->user->id === $user->id)
                                        <button class="cursor-pointer ml-6 text-sm text-red-500"
                                            wire:click="$toggle('confirmingLeavingWorkspace')">
                                            {{ __('Leave') }}
                                        </button>

                                        <!-- Remove Workspace Member -->
                                    @elseif (Gate::check('removeWorkspaceMember', $workspace))
                                        <button class="cursor-pointer ml-6 text-sm text-red-500"
                                            wire:click="confirmWorkspaceMemberRemoval('{{ $user->id }}')">
                                            {{ __('Remove') }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-slot>
            </x-jet-action-section>
        </div>
    @endif

    <!-- Role Management Modal -->
    <x-jet-dialog-modal wire:model="currentlyManagingRole">
        <x-slot name="title">
            {{ __('Manage Role') }}
        </x-slot>

        <x-slot name="content">
            <div class="relative z-0 mt-1 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer">
                @foreach ($this->roles as $index => $role)
                    <button type="button"
                        class="relative px-4 py-3 inline-flex w-full rounded-lg focus:z-10 focus:outline-none focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-600 {{ $index > 0 ? 'border-t border-gray-200 dark:border-gray-700 focus:border-none rounded-t-none' : '' }} {{ !$loop->last ? 'rounded-b-none' : '' }}"
                        wire:click="$set('currentRole', '{{ $role->key }}')">
                        <div class="{{ $currentRole !== $role->key ? 'opacity-50' : '' }}">
                            <!-- Role Name -->
                            <div class="flex items-center">
                                <div
                                    class="text-sm text-gray-600 dark:text-gray-400 {{ $currentRole == $role->key ? 'font-semibold' : '' }}">
                                    {{ $role->name }}
                                </div>

                                @if ($currentRole == $role->key)
                                    <svg class="ml-2 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @endif
                            </div>

                            <!-- Role Description -->
                            <div class="mt-2 text-xs text-gray-600 dark:text-gray-400">
                                {{ $role->description }}
                            </div>
                        </div>
                    </button>
                @endforeach
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="stopManagingRole" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-3" wire:click="updateRole" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Leave Workspace Confirmation Modal -->
    <x-jet-confirmation-modal wire:model="confirmingLeavingWorkspace">
        <x-slot name="title">
            {{ __('Leave Workspace') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you would like to leave this workspace?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingLeavingWorkspace')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="leaveWorkspace" wire:loading.attr="disabled">
                {{ __('Leave') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>

    <!-- Remove Workspace Member Confirmation Modal -->
    <x-jet-confirmation-modal wire:model="confirmingWorkspaceMemberRemoval">
        <x-slot name="title">
            {{ __('Remove Workspace Member') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you would like to remove this person from the workspace?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingWorkspaceMemberRemoval')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="removeWorkspaceMember" wire:loading.attr="disabled">
                {{ __('Remove') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
