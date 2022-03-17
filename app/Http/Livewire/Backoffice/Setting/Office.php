<?php

namespace App\Http\Livewire\Backoffice\Setting;

use App\Models\User;
use Livewire\Component;
use App\Models\Setting as ModelsSetting;
use App\Helpers\Setting as SettingHelper;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Office extends Component
{
    use AuthorizesRequests;

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
        $this->authorize('viewConfig', User::class);
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
        return view('livewire.backoffice.setting.office');
    }
}
