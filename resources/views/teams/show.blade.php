<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Workspace Settings') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @livewire('workspaces.update-workspace-name-form', ['workspace' => $workspace])

            @livewire('workspaces.workspace-member-manager', ['workspace' => $workspace])

            @if (Gate::check('delete', $workspace) && !$workspace->personal_workspace)
                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('workspaces.delete-workspace-form', ['workspace' => $workspace])
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
