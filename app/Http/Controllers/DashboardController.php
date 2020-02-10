<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home.home', [
            'title' => 'Home Dashboard',
            'currentPage' => 'home'
        ]);
    }

    public function settings()
    {
        return view('home.settings', [
            'title' => 'Settings',
            'currentPage' => 'home',
            'currencies' => \App\Currency::all()
        ]);
    }

    public function updateSettings(Request $request)
    {
        $setting = \App\Setting::find($request->id);

        if(\Auth::user()->setting->id === $setting->id) {

            // $request->select_main: wenn nicht gesetzt: null, wenn gesetzt: "on" -> wird in 0 od. 1 umgewandelt
            $selectMain = $request->select_main ? 1 : 0;
            $currency = \App\Currency::findOrFail($request->currency);

            \DB::table('settings')->where('id', $setting->id)->update([
                'select_main' => $selectMain,
                'unit' => $request->unit,
                'currency_id' => $currency->id
            ]);

            $request->session()->flash('notification', ["Settings saved succesfully", "Changes saved"]);

        } else {
            $request->session()->flash('notification', ["Settings couldn't be changed", "Permission denied"]);
        }
        return redirect('settings');
    }
}
