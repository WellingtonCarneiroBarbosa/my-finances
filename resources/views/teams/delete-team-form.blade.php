<x-jet-action-section>
    <x-slot name="title">
        {{ __('Delete Workspace') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently delete this workspace.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once a workspace is deleted, all of its resources and data will be permanently deleted. Before deleting this workspace, please download any data or information regarding this workspace that you wish to retain.') }}
        </div>

        <div class="mt-5">
            <x-jet-danger-button wire:click="$toggle('confirmingWorkspaceDeletion')" wire:loading.attr="disabled">
                {{ __('Delete Workspace') }}
            </x-jet-danger-button>
        </div>

        <!-- Delete Workspace Confirmation Modal -->
        <x-jet-confirmation-modal wire:model="confirmingWorkspaceDeletion">
            <x-slot name="title">
                {{ __('Delete Workspace') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete this workspace? Once a workspace is deleted, all of its resources and data will be permanently deleted.') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingWorkspaceDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-3" wire:click="deleteWorkspace" wire:loading.attr="disabled">
                    {{ __('Delete Workspace') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-confirmation-modal>
    </x-slot>
</x-jet-action-section>
