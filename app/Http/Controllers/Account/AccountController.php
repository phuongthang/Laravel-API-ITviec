<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginUser(Request $request)
    {
        if (Auth::guard('user')
        ->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return response()->json(['OK'], 200);
        }
        return response()->json(['Fail'], 200);
    }
}
