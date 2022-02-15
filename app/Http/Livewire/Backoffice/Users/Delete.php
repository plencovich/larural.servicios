<?php

namespace App\Http\Livewire\Backoffice\Users;

use App\Models\User;
use Livewire\Component;

class Delete extends Component
{
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function delete()
    {
        $this->user->delete();
        $this->emit('success', __('users.success_delete'), sprintf(__('users.message_delete'), $this->user->email));
        $this->emit('hideModal');
        $this->emit('refresh');
    }

    public function render()
    {
        return view('livewire.backoffice.users.delete');
    }
}
