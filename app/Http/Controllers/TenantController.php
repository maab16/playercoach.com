<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use App\User;

class TenantController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        return view('tenants.dashboard');
    }

    public function create(Request $request)
    {
        if (tenant('token') === $request->token) {
            $database = tenant()->getDatabaseName();
            $directoryPath = storage_path();

            if (! File::isDirectory($directoryPath)) {
                File::makeDirectory($directoryPath, 0777, true, true);
            }
            tenant()->deleteKey('token');
            Artisan::call('tenants:migrate');

            $user = new User;
            $user->name = tenant('name');
            $user->email = tenant('email');
            $user->password = tenant('password');
            $user->save();
        }

        return redirect()->route('tenant.dashboard');
    }
}
