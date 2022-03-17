<?php

namespace App\Http\Livewire\Backoffice\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Notifications\UserNewNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;

class Create extends Component
{
    use AuthorizesRequests;

    public $name;
    public $lastname;
    public $email;
    public $role;

    protected $listeners = ['updateSelect' => 'updateSelect'];

    public function rules()
    {
        $rules = [
            'name' => ['required'],
            'lastname' => ['required'],
            'email' => ['email:dns', 'unique:users,email'],
            'role' => ['required']
        ];

        // Role "Superior de operaciones" can only create users with role "Encargado trasladar mobiliario"
        if (auth()->user()->hasRole('Superior de operaciones')) {
            $rules['role'] = ['required', Rule::in([Role::where('name', 'Encargado trasladar mobiliario')->first()->name])];
        }

        return $rules;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Update select 2 model
     *
     * @return mixed
     */
    public function updateSelect($property, $value)
    {
        $this->$property = $value;
    }

    public function store()
    {
        $this->authorize('create', User::class);
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
        // Role "Superior de operaciones" can only create users with role "Encargado trasladar mobiliario"
        if (auth()->user()->hasRole('Superior de operaciones')) {
            $roles = Role::where('name', 'Encargado trasladar mobiliario')->get();
        } else {
            $roles = Role::all();
        }
        return view('livewire.backoffice.users.create', compact('roles'));
    }
}
