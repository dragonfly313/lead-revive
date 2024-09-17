@php
    $browser = Browser::parse($row->user_agent);
    // dd($browser->browserName());
@endphp
<div>
    <x-livewire-tables::bs4.table.cell>
        <span class="badge badge-pill badge-{{ $row->event=='login'?'success':'info' }}" style="font-size:11px">{{ ucfirst($row->event) }}</span>
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ $row->user->name }}
    </x-livewire-tables::bs4.table.cell>
    <x-livewire-tables::bs4.table.cell>
        {{ $row->user->email }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ $row->ip_address }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ $browser->browserName() }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ $browser->platformName() }}, {{ $browser->deviceModel() }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ $row->created_at->diffForHumans() }} / {{ $row->created_at }}
    </x-livewire-tables::bs4.table.cell>

</div>

