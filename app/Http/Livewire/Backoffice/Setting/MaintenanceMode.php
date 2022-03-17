<?php

namespace App\Http\Livewire\Backoffice\Setting;

use App\Models\User;
use Livewire\Component;
use App\Models\Setting as ModelsSetting;
use App\Helpers\Setting as SettingHelper;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MaintenanceMode extends Component
{
    use AuthorizesRequests;

    public $isMaintenanceStatus;
    public $isMaintenanceType;
    public $isMaintenanceTitle;
    public $isMaintenanceText;

    public function mount()
    {
        $this->isMaintenanceStatus = SettingHelper::get_setting_value('is_maintenance_status');
        $this->isMaintenanceType = SettingHelper::get_setting_value('is_maintenance_type');
        $this->isMaintenanceTitle = SettingHelper::get_setting_value('is_maintenance_title');
        $this->isMaintenanceText = SettingHelper::get_setting_value('is_maintenance_text');
    }

    public function rules()
    {
        return [
            'isMaintenanceStatus' => ['in:1,0'],
            'isMaintenanceType' => ['in:basic,contact'],
        ];
    }

    public function store()
    {
        $this->authorize('viewConfig', User::class);
        $this->validate();
        $this->updateDB('is_maintenance_status', $this->isMaintenanceStatus);
        $this->updateDB('is_maintenance_type', $this->isMaintenanceType);
        $this->updateDB('is_maintenance_title', $this->isMaintenanceTitle);
        $this->updateDB('is_maintenance_text', $this->isMaintenanceText);
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
        return view('livewire.backoffice.setting.maintenance-mode');
    }
}
