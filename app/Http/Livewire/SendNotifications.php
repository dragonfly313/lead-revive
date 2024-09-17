<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Notifications\Annoucement;
use Illuminate\Support\Facades\Notification;

class SendNotifications extends Component
{
    public $selectusers, $users, $subject, $link, $body;
    public function render()
    {
        $this->users = User::all();
        return view('livewire.send-notifications');
    }

    public function store()
    {
        $users = User::find($this->selectusers);
        $message = [
            'subject' => $this->subject,
            'body' => $this->body,
            'link' => $this->link,
        ];
        Notification::sendNow($users, new Annoucement($message));
        $this->subject = '';
        $this->body = '';
        $this->link = '';
        $this->alert('success', __('Annoucement has been send !'));
    }
}
