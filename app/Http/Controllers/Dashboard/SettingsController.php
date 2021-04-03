<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function editShippingMethods($type)
    {
        //free inner outer For shipping methods
//        dd($type);
        if ($type === 'free') {
            $shippingMethod = Setting::where('key', 'free_shipping_label')->first();
        }
        elseif ($type === 'inner') {
            $shippingMethod = Setting::where('key', 'local_label')->first();
        }
        elseif ($type === 'outer') {
            $shippingMethod = Setting::where('key', 'outer_label')->first();
        }
        else
            $shippingMethod = Setting::where('key', 'free_shipping_label')->first();

        return view('dashboard.settings.shippings.edit' , compact('shippingMethod'));
    }
}
