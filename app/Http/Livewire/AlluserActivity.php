<?php

namespace App\Http\Livewire;

use App\Models\UserLoginActivity;
use Browser;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class AlluserActivity extends DataTableComponent
{
    public function columns(): array
    {
        return [
            Column::make(__('Event'), 'event')
                ->sortable()
                ->searchable(),
            Column::make(__('User'), 'users.name'),
            Column::make(__('Email'), 'users.email'),
            Column::make(__('IP address'), 'ip_address')
                ->sortable(),
            Column::make(__('Browser')),
            Column::make(__('Device / OS')),
            Column::make('Date', 'created_at')
                ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return UserLoginActivity::with('user');
    }

    public function rowView(): string
    {
        return 'livewire.alluser-activity';
    }
}
