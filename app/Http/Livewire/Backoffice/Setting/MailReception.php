<?php

namespace App\Http\Livewire\Backoffice\Setting;

use App\Models\User;
use Livewire\Component;
use App\Models\Setting as ModelsSetting;
use App\Helpers\Setting as SettingHelper;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MailReception extends Component
{
    use AuthorizesRequests;

    public $emailContact;
    public $emailSales;

    public function mount()
    {
        $this->emailContact = SettingHelper::get_setting_value('email_contact');
        $this->emailSales = SettingHelper::get_setting_value('email_sales');
    }

    public function rules()
    {
        return [
            'emailContact' => ['email:dns'],
            'emailSales' => ['email:dns'],
        ];
    }

    public function store()
    {
        $this->authorize('viewConfig', User::class);
        $this->validate();
        $this->updateDB('email_contact', $this->emailContact);
        $this->updateDB('email_sales', $this->emailSales);
        session()->flash('message', __('success.setting_store'));
    }

    private function updateDB($name, $value)
    {
        $this->authorize('viewConfig', User::class);
        ModelsSetting::where('name', $name)
            ->where(
                function ($query) use ($value) {
                    $query->where('value', '<>', $value)
                        ->orWhereNull('value');
                }
            )->update(['value' => $value]);
    }

    public function render()
    {
        $this->authorize('viewConfig', User::class);
        return view('livewire.backoffice.setting.mail-reception');
    }
}
