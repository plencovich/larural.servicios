<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Logout extends Component
{

    public function mount()
    {
        Auth::logout();

        return redirect('/');
    }

    public function render()
    {
        return '';
    }
}
