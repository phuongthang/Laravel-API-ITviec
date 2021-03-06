<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ApplyController extends Controller
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
        DB::beginTransaction();
        try {
            $applies = new Apply();
            $applies->user_id = $request->user_id;
            $applies->organization_id = $request->organization_id;
            $applies->job_id = $request->job_id;
            $applies->email = $request->email;
            if ($request->has('image')) {
                $file =  $request->file('image');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $request->image->move(public_path("/upload/apply"), $fileName);
                $applies->image = "/upload/apply" . "/" . $fileName;
            }
            $applies->save();
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
    public function show(Request $request)
    {
        $applies = DB::table('applies')
        ->join('organizations', 'applies.organization_id', '=', 'organizations.id')
        ->join('jobs', 'applies.job_id', '=', 'jobs.id')
        ->join('users', 'applies.user_id', '=', 'users.id')
        ->where([['jobs.organization_id',$request->organization_id],['jobs.id',$request->job_id]])
        ->select('applies.*','users.fullname','users.position','users.image as images')
        ->get();
        if($applies){
            return response()->json(['applies' => $applies],Response::HTTP_OK);
        }
        else{
            return response()->json(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        $confirms = DB::table('applies')
        ->join('organizations', 'applies.organization_id', '=', 'organizations.id')
        ->join('jobs', 'applies.job_id', '=', 'jobs.id')
        ->join('users', 'applies.user_id', '=', 'users.id')
        ->where('users.id',$request->user_id)
        ->select('applies.*','organizations.image as images','jobs.title','organizations.id as organization_id','jobs.id as job_id')
        ->get();
        if($confirms){
            return response()->json(['confirms' => $confirms],Response::HTTP_OK);
        }
        else{
            return response()->json(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
            $applies = Apply::find($request->id);
            if($applies){
                $applies->status = $request->flag;
                $applies->save();

                DB::commit();

                return response()->json(Response::HTTP_OK);
            }
            else
            {
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
