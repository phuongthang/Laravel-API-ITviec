<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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
        $admin = Admin::find($request->id);
        if($admin){
            return response()->json(['admin' => $admin],Response::HTTP_OK);
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
            $admin = Admin::find($request->id);
            if($admin){
                $admin->fullname = $request->fullname;
                $admin->position = $request->position;
                $admin->address = $request->address;
                $admin->phone = $request->phone;
                $admin->description = $request->description;

                if ($request->has('image')) {
                    $file =  $request->file('image');
                    $fileName = time() . '.' . $file->getClientOriginalExtension();
                    $request->image->move(public_path("/upload/admin"), $fileName);
                    $admin->image = "/upload/admin"."/".$fileName;
                }

                $admin->save();

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
