<?php

namespace App\Http\Livewire\Backoffice\Setting;

use App\Models\User;
use Livewire\Component;
use App\Models\Setting as ModelsSetting;
use App\Helpers\Setting as SettingHelper;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SocialNetworks extends Component
{
    use AuthorizesRequests;

    public $socialWhatsapp;
    public $socialFacebook;
    public $socialInstagram;
    public $socialTwitter;
    public $socialTelegram;
    public $socialSkype;
    public $socialLinkedin;
    public $socialYoutube;


    public function mount()
    {
        $this->socialWhatsapp = SettingHelper::get_setting_value('social_whatsapp');
        $this->socialFacebook = SettingHelper::get_setting_value('social_facebook');
        $this->socialInstagram = SettingHelper::get_setting_value('social_instagram');
        $this->socialTwitter = SettingHelper::get_setting_value('social_twitter');
        $this->socialTelegram = SettingHelper::get_setting_value('social_telegram');
        $this->socialSkype = SettingHelper::get_setting_value('social_skype');
        $this->socialLinkedin = SettingHelper::get_setting_value('social_linkedin');
        $this->socialYoutube = SettingHelper::get_setting_value('social_youtube');
    }

    public function rules()
    {
        return [
            'socialWhatsapp' => ['integer', 'digits_between:8,10'],
            'socialFacebook' => ['url'],
            'socialInstagram' => ['url'],
            'socialTwitter' => ['url'],
            'socialTelegram' => ['integer', 'digits_between:8,10'],
            'socialSkype' => ['url'],
            'socialLinkedin' => ['url'],
            'socialYoutube' => ['url'],
        ];
    }

    public function store()
    {
        $this->authorize('viewConfig', User::class);
        $this->validate();
        $this->updateDB('social_whatsapp', $this->socialWhatsapp);
        $this->updateDB('social_facebook', $this->socialFacebook);
        $this->updateDB('social_instagram', $this->socialInstagram);
        $this->updateDB('social_twitter', $this->socialTwitter);
        $this->updateDB('social_telegram', $this->socialTelegram);
        $this->updateDB('social_skype', $this->socialSkype);
        $this->updateDB('social_linkedin', $this->socialLinkedin);
        $this->updateDB('social_youtube', $this->socialYoutube);
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
        return view('livewire.backoffice.setting.social-networks');
    }
}
