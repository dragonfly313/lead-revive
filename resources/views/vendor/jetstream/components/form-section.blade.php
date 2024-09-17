@props(['submit'])

<div {{ $attributes->merge(['class' => 'row']) }}>
    <div class="col-md-12 mt-3">
        <div class="card mb-2 mb-lg-2">
            <div class="card-header">
                <h5 class="card-title">
                    <x-jet-section-title>
                        <x-slot name="title">{{ $title }}</x-slot>
                        <x-slot name="description"></x-slot>
                    </x-jet-section-title>
                </h5>
            </div>
            <div class="card-body">
                <x-jet-section-title>
                    <x-slot name="title"></x-slot>
                    <x-slot name="description">{{ $description }}</x-slot>
                </x-jet-section-title>
                <form wire:submit.prevent="{{ $submit }}">
                    <div>
                        {{ $form }}
                    </div>

                    @if (isset($actions))
                        <div class="card-footer d-flex justify-content-end">
                            {{ $actions }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
