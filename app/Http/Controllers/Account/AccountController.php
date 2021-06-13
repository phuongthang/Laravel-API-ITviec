<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if ($request->role === '0') {
            if (Auth::guard('admin')
                ->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))
            ) {
                $admin = Admin::where('email', $request->email)->first();
                if ($admin) {
                    return response()->json(['data' => $admin], Response::HTTP_OK);
                } else {
                    return response()->json(Response::HTTP_UNAUTHORIZED);
                }
            } else {
                return response()->json(Response::HTTP_UNAUTHORIZED);
            }
        }
        if ($request->role === '1') {
            if (Auth::guard('user')
                ->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))
            ) {
                $user = User::where('email', $request->email)->first();
                if ($user) {
                    return response()->json(['data' => $user], Response::HTTP_OK);
                } else {
                    return response()->json(Response::HTTP_UNAUTHORIZED);
                }
            } else {
                return response()->json(Response::HTTP_UNAUTHORIZED);
            }
        }
        if ($request->role === '2') {
            if (Auth::guard('organization')
                ->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))
            ) {
                $organization = Organization::where('email', $request->email)->first();
                if ($organization) {
                    return response()->json(['data' => $organization], Response::HTTP_OK);
                } else {
                    return response()->json(Response::HTTP_UNAUTHORIZED);
                }
            } else {
                return response()->json(Response::HTTP_UNAUTHORIZED);
            }
        }
    }
}
