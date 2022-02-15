<?php

namespace App\Http\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Component;

class Login extends Component
{
    public $email, $password, $remember;

    public function render()
    {
        return view('livewire.auth.login')->layout('layout_full');
    }

    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email:dns'],
            'password' => ['required', 'string'],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function login()
    {
        $this->validate();

        if ($this->ensureIsNotRateLimited() && $this->authenticate()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    public function ensureIsNotRateLimited()
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return true;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        $this->addError('email', __('auth.throttle', [
            'seconds' => $seconds,
            'minutes' => ceil($seconds / 60),
        ]));

        return false;
    }

    public function authenticate()
    {
        if (Auth::attempt($this->only(['email', 'password']), $this->remember)) {
            RateLimiter::clear($this->throttleKey());

            return true;
        }

        RateLimiter::hit($this->throttleKey());

        $this->addError('email', __('auth.failed'));

        return false;
    }

    public function throttleKey()
    {
        return Str::lower($this->email) . '|' . request()->ip();
    }
}
