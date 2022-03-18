<?php

namespace App\Http\Livewire\Backoffice\Setting;

use Livewire\Component;
use App\Helpers\Setting as SettingHelper;
use App\Models\Setting as ModelsSetting;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PaymentMethods extends Component
{
    use AuthorizesRequests;

    public $mpUserId;
    public $mpClientId;
    public $mpClientSecret;
    public $mpAccessToken;

    public function mount()
    {
        $this->mpUserId = SettingHelper::get_setting_value('mp_user_id');
        $this->mpClientId = SettingHelper::get_setting_value('mp_client_id');
        $this->mpClientSecret = SettingHelper::get_setting_value('mp_client_secret');
        $this->mpAccessToken = SettingHelper::get_setting_value('mp_access_token');
    }

    public function store()
    {
        $this->authorize('viewConfig', User::class);
        $this->updateDB('mp_user_id', $this->mpUserId);
        $this->updateDB('mp_client_id', $this->mpClientId);
        $this->updateDB('mp_client_secret', $this->mpClientSecret);
        $this->updateDB('mp_access_token', $this->mpAccessToken);
        session()->flash('message', __('forms.setting_store'));
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
        return view('livewire.backoffice.setting.payment-methods');
    }
}
