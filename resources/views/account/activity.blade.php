<x-account-layout>
    <x-slot name="header">
        <div class="d-none d-lg-block">
            <h1 class="h2 text-white">{{ __('Activity')  }}</h1>
        </div>
    </x-slot>
    <div class="card">
        <div class="card-header">
          <h5 class="card-title">{{ __('Your activity') }}</h5>
        </div>
       
        <!-- Body -->
        <div class="card-body">
            <livewire:user-activity>
        </div>
    </div>
</x-account-layout>