<?php

namespace App\Http\Livewire\Backoffice\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Show extends Component
{
    use AuthorizesRequests;

    protected $listeners = ['customerShow'];
    public $componentShow;
    public $params;

    public function customerShow($component, ...$params)
    {
        $this->componentShow = $component;
        $this->params = $params;
    }

    public function render()
    {
        $this->authorize('viewAny', User::class);
        return view('livewire.backoffice.users.show');
    }
}
