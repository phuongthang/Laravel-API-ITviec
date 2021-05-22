<?php

namespace App\Http\Controllers\Address;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AddressController extends Controller
{
    public function province(){
        $province = Province::all();
        if($province){
            return response()->json(['province'=>$province],Response::HTTP_OK);
        }
        else{
            return response()->json(['error','error'],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }

    public function district($id){
        $district = District::where('_province_id',$id)->get();
        if($district){
            return response()->json(['district'=>$district],Response::HTTP_OK);
        }
        else{
            return response()->json(['error','error'],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }

    public function ward($id){
        $ward = Ward::where('_district_id',$id)->get();
        if($ward){
            return response()->json(['ward'=>$ward],Response::HTTP_OK);
        }
        else{
            return response()->json(['error','error'],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }
}
