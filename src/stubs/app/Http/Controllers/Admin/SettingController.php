<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SettingController extends Controller
{


    public function index(Request $request):Response
    {
        $data = [
            'settings' => Setting::all(),
        ];

        return Inertia::render('Admin/Settings', $data);
    }


    /**
     * settings.create - create a new setting
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        // get the setting from the request
        $setting = $request->validate([
            'name' => 'required|string',
            'value' => 'required',
        ]);
        // create the setting
        Setting::create($setting);

        return Inertia::render('Setting/Create');
    }

    //setting.store - POST - /settings

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // store the setting
        $setting = Setting::create($request->validate([
            'name' => 'required',
            'value' => 'required',
        ]));
        // redirect back with data
        return redirect()->back();
    }


    //setting.show
    public function show(Setting $setting)
    {
        return Inertia::render('Setting/Show', [
            'setting' => $setting,
        ]);
    }

    //setting.edit
    public function edit(Setting $setting)
    {
        return Inertia::render('Setting/Edit', [
            'setting' => $setting,
        ]);
    }

    //setting.update
    public function update(Request $request, Setting $setting)
    {
        $setting->update($request->validate([
            'name' => 'required',
            'value' => 'required',
        ]));
        return redirect()->back();
    }

    //setting.destroy

    /**
     * @param Setting $setting
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();
        return redirect()->back();
    }

}


