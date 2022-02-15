<?php

namespace App\Http\Livewire\Backoffice\Users;

use App\Models\User;
use App\Notifications\UserNewNotification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Create extends Component
{

    public $name;
    public $lastname;
    public $email;
    public $role;

    public function rules()
    {
        return [
            'name' => ['required'],
            'lastname' => ['required'],
            'email' => ['email:dns', 'unique:users,email'],
            'role' => ['required']
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();
        DB::transaction(function () {
            $password = Str::random(8);
            $user = User::create([
                'name' => $this->name,
                'lastname' => $this->lastname,
                'email' => $this->email,
                'password' => bcrypt($password),
            ])->assignRole($this->role);
            $user->notify(new UserNewNotification($password));
        });
        $this->emit('success', __('users.success_create'), sprintf(__('users.message_create'), $this->email));
        $this->reset();
        $this->emit('customerShow', false);
    }

    public function render()
    {
        $roles = Role::all();
        return view('livewire.backoffice.users.create', compact('roles'));
    }
}
