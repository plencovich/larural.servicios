<?php

namespace App\Http\Livewire\Backoffice\Users;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Confirms extends Component
{

    public $password;
    public $passwordConfirm;

    public function rules()
    {
        return [
            'password' => ['required', 'min:8', 'max:10'],
            'passwordConfirm' => ['required', 'same:password']
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();

        User::find(auth()->user()->id)->update([
            'password' => Hash::make($this->password),
            'account_verified_at' => Carbon::now()->toDateTimeString()
        ]);

        return redirect()->to(route('backoffice.home'));
    }

    public function render()
    {
        return view('livewire.backoffice.users.confirms');
    }
}
