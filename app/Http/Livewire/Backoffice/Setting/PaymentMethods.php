<?php

namespace App\Http\Livewire\Backoffice\Setting;

use Livewire\Component;
use App\Helpers\Setting as SettingHelper;
use App\Models\Setting as ModelsSetting;

class PaymentMethods extends Component
{
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
        $this->updateDB('mp_user_id', $this->mpUserId);
        $this->updateDB('mp_client_id', $this->mpClientId);
        $this->updateDB('mp_client_secret', $this->mpClientSecret);
        $this->updateDB('mp_access_token', $this->mpAccessToken);
        session()->flash('message', __('forms.setting_store'));
    }

    private function updateDB($name, $value)
    {
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
        return view('livewire.backoffice.setting.payment-methods');
    }
}
