<?php

namespace App\Http\Livewire\Backoffice\Setting;

use Livewire\Component;
use App\Helpers\Setting as SettingHelper;
use App\Models\Setting as ModelsSetting;

class MaintenanceMode extends Component
{
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
        $this->validate();
        $this->updateDB('is_maintenance_status', $this->isMaintenanceStatus);
        $this->updateDB('is_maintenance_type', $this->isMaintenanceType);
        $this->updateDB('is_maintenance_title', $this->isMaintenanceTitle);
        $this->updateDB('is_maintenance_text', $this->isMaintenanceText);
        session()->flash('message', __('success.setting_store'));
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
        return view('livewire.backoffice.setting.maintenance-mode');
    }
}
