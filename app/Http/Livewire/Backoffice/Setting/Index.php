<?php

namespace App\Http\Livewire\Backoffice\Setting;

use App\Models\User;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('viewConfig', User::class);
        return view('livewire.backoffice.setting.index');
    }
}
