<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
    public function edit($id)
    {
        $user = User::find($id);
        if($user){
            return response()->json(['user' => $user],Response::HTTP_OK);
        }
        else{
            return response()->json(Response::HTTP_OK);
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
            $user = User::find($request->id);
            if($user){
                $user->fullname = $request->fullname;
                $user->position = $request->position;
                $user->address = $request->address;
                $user->phone = $request->phone;
                $user->description = $request->description;
                if ($request->has('image')) {
                    $file =  $request->file('image');
                    $fileName = time() . '.' . $file->getClientOriginalExtension();
                    $request->image->move(public_path("/upload/user"), $fileName);
                    $user->image = "/upload/user"."/".$fileName;
                }

                $user->save();

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
