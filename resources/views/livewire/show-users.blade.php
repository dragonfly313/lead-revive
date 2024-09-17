<div>
    <x-livewire-tables::bs4.table.cell>
        <img src="{{ $row->profile_photo_url }}" class="img-fluid rounded-circle avatar" alt="Admin User"> 
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ $row->name }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ $row->email }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {!! $row->isVerified() ? '<span class="badge badge-soft-success">Verified</span>' : '<span class="badge badge-soft-danger">Unverified</span> ' !!}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {!! $row->isActive() ? '<span class="badge badge-soft-success">Active</span>' : '<span class="badge badge-soft-danger">Inactive</span>' !!}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ $row->getRolesLabelAttribute() }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ $row->created_at->diffForHumans() }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        @include('admin.includes.actions', ['user' => $row])
    </x-livewire-tables::bs4.table.cell>
</div>