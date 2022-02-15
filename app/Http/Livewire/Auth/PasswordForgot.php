<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class PasswordForgot extends Component
{
    public $email, $status;

    public function render()
    {
        return view('livewire.auth.password-forgot')->layout('layout_full');
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email:dns'],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function sendResetLink()
    {
        $this->validate();

        $status = Password::sendResetLink($this->only(['email']));

        if ($status == Password::RESET_LINK_SENT) {
            $this->status = __($status);
        } else {
            $this->addError('email', __($status));
        }
    }
}
