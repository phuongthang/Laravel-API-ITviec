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
            $admin = Admin::where('email',$request->email)->first();
            if($admin){
                return response()->json(['data'=>$admin],Response::HTTP_OK);
            }
            else{
                return response()->json(Response::HTTP_UNAUTHORIZED);
            }
        }
        if ($request->role === '1') {
            $user = User::where('email',$request->email)->first();
            if($user){
                return response()->json(['data'=>$user],Response::HTTP_OK);
            }
            else{
                return response()->json(Response::HTTP_UNAUTHORIZED);
            }
        }
        if ($request->role === '2') {
            $organization = Organization::where('email',$request->email)->first();
            if($organization){
                return response()->json(['data'=>$organization],Response::HTTP_OK);
            }
            else{
                return response()->json(Response::HTTP_UNAUTHORIZED);
            }
        }
    }
}
