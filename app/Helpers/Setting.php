<?php
//app/Helpers/Envato/User.php
namespace App\Helpers;

use App\Models\Setting as ModelsSetting;

class Setting
{
    /**
     * @param string value
     * 
     * @return string
     */
    public static function get_setting_value($name)
    {
        $setting = ModelsSetting::where('name', $name)->first();

        return (!is_null($setting) ? $setting->value : '');
    }
}
