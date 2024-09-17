<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class ShowUsers extends DataTableComponent
{
    public function columns(): array
    {
        return [
            Column::make(__('Avatar')),
            Column::make(__('Name')),
            Column::make(__('Email'), 'email')
            ->searchable()
            ->sortable(),
            Column::make(__('Verified'), 'email_verified_at')
            ->sortable(),
            Column::make(__('Satus'), 'active')
            ->sortable(),
            Column::make('Role', 'roles.name'),
            Column::make('Date', 'created_at')
                ->sortable(),
            Column::make('Actions')
        ];
    }
    // public function columns() : array
    // {
    //     return [
    //         Column::make('Avatar')
    //             ->format(function (User $model) {
    //                 return $this->image($model->profile_photo_url, $model->name, ['class' => 'img-fluid rounded-circle avatar']);
    //             }),
    //         Column::make('Name')
    //             ->searchable()
    //             ->sortable(),
    //         Column::make('E-mail', 'email')
    //             ->searchable()
    //             ->sortable()
    //             ->format(function (User $model) {
    //                 return $this->mailto($model->email, null, ['target' => '_blank']);
    //             }),
    //         Column::make('Verified', 'email_verified_at')
    //             ->sortable()
    //             ->searchable()
    //             ->format(function (User $model) {
    //                 return $this->html($model->isVerified() ? '<span class="badge badge-soft-success">Verified</span>' : '<span class="badge badge-soft-danger">Unverified</span>');
    //             }),
    //         Column::make('Status', 'active')
    //             ->sortable()
    //             ->searchable()
    //             ->format(function (User $model) {
    //                 return $this->html($model->isActive() ? '<span class="badge badge-soft-success">Active</span>' : '<span class="badge badge-soft-danger">Inactive</span>');
    //             }),
    //         Column::make('Role', 'roles.name')
    //             ->searchable()
    //             ->sortable()
    //             ->format(function (User $model) {
    //                 return $model->getRolesLabelAttribute();
    //                 // if(\Laravel\Jetstream\Jetstream::hasRoles()){
    //                 //     'admin';
    //                 // }
    //             }),

    //         Column::make('Actions')
    //             ->format(function (User $model) {
    //                 return view('admin.includes.actions', ['user' => $model]);
    //             }),
    //     ];
    // }

    public function query() : Builder
    {
        return User::with('roles')->withCount('permissions');
    }

    public function rowView(): string
    {
        return 'livewire.show-users';
    }
}
