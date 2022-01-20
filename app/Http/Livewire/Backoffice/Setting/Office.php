<?php

namespace App\Http\Livewire\Backoffice\Setting;

use Livewire\Component;
use App\Helpers\Setting as SettingHelper;
use App\Models\Setting as ModelsSetting;

class Office extends Component
{
    public $projectOffice;
    public $projectAddress;
    public $projectCity;
    public $projectPhone;
    public $projectGmapsLink;
    public $projectGpsIframe;
    public $projectHoursOffice;

    public function mount()
    {
        $this->projectOffice = SettingHelper::get_setting_value('project_office');
        $this->projectAddress = SettingHelper::get_setting_value('project_address');
        $this->projectCity = SettingHelper::get_setting_value('project_city');
        $this->projectPhone = SettingHelper::get_setting_value('project_phone');
        $this->projectGmapsLink = SettingHelper::get_setting_value('project_gmaps_link');
        $this->projectGpsIframe = SettingHelper::get_setting_value('project_gmaps_iframe');
        $this->projectHoursOffice = SettingHelper::get_setting_value('project_hours_office');
    }

    public function rules()
    {
        return [
            'projectPhone' => ['integer', 'digits_between:8,10'],
            'projectGmapsLink' => ['url'],
            'projectGpsIframe' => ['url'],
        ];
    }

    public function store()
    {
        $this->validate();
        $this->updateDB('project_office', $this->projectOffice);
        $this->updateDB('project_address', $this->projectAddress);
        $this->updateDB('project_city', $this->projectCity);
        $this->updateDB('project_phone', $this->projectPhone);
        $this->updateDB('project_gmaps_link', $this->projectGmapsLink);
        $this->updateDB('project_gmaps_iframe', $this->projectGpsIframe);
        $this->updateDB('project_hours_office', $this->projectHoursOffice);
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
        return view('livewire.backoffice.setting.office');
    }
}
