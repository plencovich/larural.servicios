<?php

namespace App\Http\Livewire\Backoffice\Setting;

use Livewire\Component;
use App\Helpers\Setting as SettingHelper;
use App\Models\Setting as ModelsSetting;

class Company extends Component
{

    public $projectName;
    public $projectSlogan;
    public $projectEmail;
    public $projectDomain;
    public $linkAfip;

    public function rules()
    {
        return [
            'projectEmail' => ['email:dns'],
            'projectDomain' => ['url'],
            'linkAfip' => ['url'],
        ];
    }

    public function mount()
    {
        $this->projectName = SettingHelper::get_setting_value('project_name');
        $this->projectSlogan = SettingHelper::get_setting_value('project_slogan');
        $this->projectEmail = SettingHelper::get_setting_value('project_email');
        $this->projectDomain = SettingHelper::get_setting_value('project_domain');
        $this->linkAfip = SettingHelper::get_setting_value('link_afip');
    }

    public function store()
    {
        $this->validate();
        $this->updateDB('project_name', $this->projectName);
        $this->updateDB('project_slogan', $this->projectSlogan);
        $this->updateDB('project_email', $this->projectEmail);
        $this->updateDB('project_domain', $this->projectDomain);
        $this->updateDB('link_afip', $this->linkAfip);
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
        return view('livewire.backoffice.setting.company');
    }
}
