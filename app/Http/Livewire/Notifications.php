<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Notifications extends Component
{
    public $notifications;

    public function render()
    {
        $this->notifications = auth()->user()->unreadNotifications;

        return view('livewire.notifications');
    }

    public function markAllAsRead()
    {
        $this->notifications->markAsRead();
        $this->alert('success', __('Notifications has been marked as read !'));
    }
}
