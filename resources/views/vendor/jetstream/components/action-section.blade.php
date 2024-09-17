<div {{ $attributes->merge(['class' => 'row']) }}>
    <div class="col-md-12">
        <div class="card shadow-sm">
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
                {{ $content }}
            </div>
        </div>
    </div>
</div>
