<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $organization = Organization::find($request->id);
        if($organization){
            return response()->json(['organization' => $organization],Response::HTTP_OK);
        }
        else{
            return response()->json(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $organization = Organization::find($request->id);
            if($organization){
                $organization->fullname = $request->fullname;
                $organization->field = $request->field;
                $organization->address = $request->address;
                $organization->phone = $request->phone;
                $organization->description = $request->description;
                $organization->establishment = $request->establishment;

                if ($request->has('image')) {
                    $file =  $request->file('image');
                    $fileName = time() . '.' . $file->getClientOriginalExtension();
                    $request->image->move(public_path("/upload/organization"), $fileName);
                    $organization->image = "/upload/organization"."/".$fileName;
                }
                $organization->save();

                DB::commit();


                return response()->json(Response::HTTP_OK);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
