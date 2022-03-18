<?php

namespace App\Http\Livewire\Backoffice\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Delete extends Component
{
    use AuthorizesRequests;

    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function delete()
    {
        $this->authorize('delete', $this->user);
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
