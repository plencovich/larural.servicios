<?php

namespace App\Http\Livewire\Backoffice\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends Component
{
    use AuthorizesRequests;

    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function rules()
    {
        return [
            'user.name' => ['required'],
            'user.lastname' => ['required'],
            'user.email' => ['email:dns', 'unique:customers,email,' . $this->user->id],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function store()
    {
        $this->authorize('update', $this->user);
        $this->validate();
        //$this->user->save();
        $this->emit('success', __('users.success_edit'), sprintf(__('users.message_edit'), $this->user->email));
        $this->reset();
        $this->emit('customerShow', false);
    }

    public function render()
    {
        return view('livewire.backoffice.users.edit');
    }
}
