<x-jet-form-section submit="updateWorkspaceName">
    <x-slot name="title">
        {{ __('Workspace Name') }}
    </x-slot>

    <x-slot name="description">
        {{ __('The workspace\'s name and owner information.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Workspace Owner Information -->
        <div class="col-span-6">
            <x-jet-label value="{{ __('Workspace Owner') }}" />

            <div class="flex items-center mt-2">
                <img class="w-12 h-12 rounded-full object-cover" src="{{ $workspace->owner->profile_photo_url }}"
                    alt="{{ $workspace->owner->name }}">

                <div class="ml-4 leading-tight">
                    <div class="dark:text-white">{{ $workspace->owner->name }}</div>
                    <div class="text-gray-700 dark:text-gray-300 text-sm">{{ $workspace->owner->email }}</div>
                </div>
            </div>
        </div>

        <!-- Workspace Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Workspace Name') }}" />

            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name"
                :disabled="!Gate::check('update', $workspace)" />

            <x-jet-input-error for="name" class="mt-2" />
        </div>
    </x-slot>

    @if (Gate::check('update', $workspace))
        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-jet-action-message>

            <x-jet-button>
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    @endif
</x-jet-form-section>
