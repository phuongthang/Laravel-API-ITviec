<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CV;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CVController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $cv = CV::where('user_id', $id)->get();
        if (count($cv) > 0) {
            return response()->json(['data' => $cv->first(), 'flag' => true], Response::HTTP_OK);
        } else {
            $user = User::find($id);
            if ($user) {
                $user->flag = false;
                return response()->json(['data' => $user, 'flag' => false], Response::HTTP_OK);
            } else {
                return response()->json(Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $cv = new CV();
            $cv->fullname = $request->fullname;
            $cv->position = $request->position;
            $cv->address = $request->address;
            $cv->phone = $request->phone;
            $cv->email = $request->email;
            $cv->description = $request->description;
            $cv->user_id = $request->id;
            if ($request->has('image')) {
                $file =  $request->file('image');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $request->image->move(public_path("/upload/cv"), $fileName);
                $cv->image = "/upload/cv" . "/" . $fileName;
            }
            $cv->save();
            DB::commit();


            return response()->json(Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
        //
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
            $cv = CV::where('user_id', $request->id)->first();
            if ($cv) {
                $cv->fullname = $request->fullname;
                $cv->position = $request->position;
                $cv->address = $request->address;
                $cv->phone = $request->phone;
                $cv->email = $request->email;
                $cv->description = $request->description;
                if ($request->has('image')) {
                    $file =  $request->file('image');
                    $fileName = time() . '.' . $file->getClientOriginalExtension();
                    $request->image->move(public_path("/upload/cv"), $fileName);
                    $cv->image = "/upload/cv" . "/" . $fileName;
                }
                $cv->save();
                DB::commit();
                return response()->json(Response::HTTP_OK);
            }
            else{
                return response()->json(Response::HTTP_INTERNAL_SERVER_ERROR);
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
