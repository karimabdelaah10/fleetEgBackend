<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Modules\Config\Enums\ConfigsEnum;
use App\Modules\Config\Models\Config;
use App\Modules\Users\Enums\UserEnum;
use App\Modules\Users\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile_number' => 'required|string|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'type'=> UserEnum::CUSTOMER,
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password' => $request->password,
        ]);
        $config = Config::where('title' , ConfigsEnum::AUTO_REGISTER)->first();
        if (!$config->value){
            throw ValidationException::withMessages([
                'user_inactive' => __('auth.registered_user_is_verified'),
            ]);
        }else{
            $user->update(['is_verified' => 1]);
            Auth::login($user);
            event(new Registered($user));

        }

        flash(trans('auth.registration done'))->success();
        return redirect(RouteServiceProvider::HOME);
    }
}
