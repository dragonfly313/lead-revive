<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Snowfire\Beautymail\Beautymail;

class Payments extends Component
{
    use LivewireAlert;

    public $paymentMethods = [];

    public function mount()
    {
        $this->getPayment();
    }

    public function getPayment()
    {
        $this->paymentMethods = currentTeam()->paymentMethods()->map(function ($paymentMethod) {
            return $paymentMethod->asStripePaymentMethod();
        });
    }

    public function delete($id)
    {
        $paymentMethod = currentTeam()->findPaymentMethod($id);
        $paymentMethod->delete();

        $this->alert('success', __('Payment method has been deleted !'));
        $this->getPayment();
    }

    public function makeDefault($paymentID)
    {
        currentTeam()->updateDefaultPaymentMethod($paymentID);

        $this->getPayment();
        $this->alert('success', __('Payment method has been updated !'));
    }

    public function render()
    {
        return view('livewire.payments');
    }
}
