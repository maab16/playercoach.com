<?php

namespace App\Http\Controllers\Facility;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Stancl\Tenancy\Tenant;

class AuthController extends Controller
{
	/**
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function showTenantRegisterForm()
    {
    	return view('facilities.auth.register');
    }

    public function register(Request $request)
    {
    	$request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'domain' => ['required', 'string'],
        ]);

	    $user = new User;
	    $user->name = $request->name;
	    $user->email = $request->email;
	    $user->password = Hash::make($request->password);

	    if($user->save()) {
	    	$domain = $request->domain;
	    	$token = md5(rand(1, 32) . microtime());
	    	$tenant = Tenant::new()->withDomains([
	    	    $domain
	    	])->withData([
	    	    'domain' => $domain,
	    	    'name' => $request->name,
	    	    'email' => $request->email,
	    	    'password' => Hash::make($request->password),
	    	    'cms' => json_encode($request->cms),
	    	    'token' => $token,
	    	])->save();
	    }

	    return redirect()->route('tenant.create', ['token' => $token])->tenant($domain);
    }
}
