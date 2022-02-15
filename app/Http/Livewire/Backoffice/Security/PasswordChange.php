<?php

namespace App\Http\Livewire\Backoffice\Security;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class PasswordChange extends Component
{

    public $passwordCurrent;
    public $passwordNew;
    public $passwordConfirm;

    public function rules()
    {
        return [
            'passwordCurrent' => ['required', new MatchOldPassword],
            'passwordNew' => ['required', 'min:8', 'max:10'],
            'passwordConfirm' => ['required', 'same:passwordConfirm']
        ];
    }

    public function change()
    {
        $this->validate();
        User::find(auth()->user()->id)->update(['password' => Hash::make($this->passwordNew)]);
        $this->reset(['passwordCurrent', 'passwordNew', 'passwordConfirm']);
        session()->flash('message', __('passwords.password_change'));
    }

    public function render()
    {
        return view('livewire.backoffice.security.password-change');
    }
}
