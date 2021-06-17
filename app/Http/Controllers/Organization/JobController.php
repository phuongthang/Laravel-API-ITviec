<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jobs = DB::table('jobs')
        ->join('organizations', 'jobs.organization_id', '=', 'organizations.id')
        ->where([['jobs.flag_delete',1],['jobs.organization_id',$request->organization_id]])
        ->select('jobs.*', 'organizations.image');
        if($request->title){
            $jobs->where('jobs.title', 'like', '%' . $request->title . '%');
        }
        if($request->province){
            $jobs->where('jobs.province',$request->province);
        }
        if($request->language){
            $jobs->where('jobs.language_id',$request->language);
        }
        if($request->type){
            $jobs->where('jobs.type_id',$request->type);
        }
        if($request->experience){
            $jobs->where('jobs.experience_id',$request->experience);
        }
        if($request->salary){
            $valueAbout = explode('-', $request->salary);
            if (count($valueAbout) == 2) {
                $jobs->where([['jobs.salary', '>',(int) $valueAbout[0]], ['jobs.salary', '<=', (int)$valueAbout[1]]]);
            }
        }
        $jobs = $jobs->get();
        if($jobs){
            return response()->json(['jobs' => $jobs],Response::HTTP_OK);
        }
        else{
            return response()->json(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        $jobs = DB::table('jobs')
        ->join('organizations', 'jobs.organization_id', '=', 'organizations.id')
        ->where([['jobs.flag_delete',1],['jobs.active',1],['jobs.status',1]])
        ->select('jobs.*', 'organizations.image')
        ->get();
        if($jobs){
            return response()->json(['jobs' => $jobs],Response::HTTP_OK);
        }
        else{
            return response()->json(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function query(Request $request)
    {
        $jobs = DB::table('jobs')
        ->join('organizations', 'jobs.organization_id', '=', 'organizations.id')
        ->select('jobs.*', 'organizations.image')->where([['jobs.flag_delete',1],['jobs.status',1]]);
        if($request->fullname){
            $jobs->where('organizations.fullname', 'like', '%' . $request->fullname . '%');
        }
        if($request->title){
            $jobs->where('jobs.title', 'like', '%' . $request->title . '%');
        }
        if($request->province){
            $jobs->where('jobs.province',$request->province);
        }
        if($request->language){
            $jobs->where('jobs.language_id',$request->language);
        }
        if($request->type){
            $jobs->where('jobs.type_id',$request->type);
        }
        if($request->experience){
            $jobs->where('jobs.experience_id',$request->experience);
        }
        if($request->salary){
            $valueAbout = explode('-', $request->salary);
            if (count($valueAbout) == 2) {
                $jobs->where([['jobs.salary', '>',(int)$valueAbout[0]], ['jobs.salary', '<=', (int)$valueAbout[1]]]);
            }
        }
        $jobs = $jobs->get();
        if($jobs){
            return response()->json(['jobs' => $jobs],Response::HTTP_OK);
        }
        else{
            return response()->json(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
            $job = new Job();
            $job->title = $request->title;
            $job->start_date = $request->start_date;
            $job->end_date = $request->end_date;
            $job->position = $request->position;
            $job->salary = $request->salary;
            $job->description = $request->description;
            $job->location = $request->location;
            $job->count = (int)$request->count;
            $job->province = (int)$request->province;
            $job->district = (int)$request->district;
            $job->ward = (int)$request->ward;
            $job->organization_id = (int)$request->id;
            $job->required = $request->required;
            $job->type_id = (int)$request->type;
            $job->experience_id = (int)$request->experience;
            $job->language_id = (int)$request->language;

            $job->save();
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
        $jobs = DB::table('jobs')
        ->join('organizations', 'jobs.organization_id', '=', 'organizations.id')
        ->where([['jobs.flag_delete',1],['jobs.organization_id',$request->organization_id],['jobs.id',$request->job_id]])
        ->select('jobs.*', 'organizations.image','organizations.description as organization_description','organizations.field','organizations.fullname')
        ->first();

        $active = DB::table('applies')
        ->where([['job_id',$request->job_id],['status',1]])
        ->select(DB::raw('COUNT(status) as count'))
        ->first();

        $total = DB::table('applies')
        ->where('job_id',$request->job_id)
        ->select(DB::raw('COUNT(status) as count'))
        ->first();

        if($jobs){
            return response()->json(['jobs' => $jobs,'active'=>$active,'total'=>$total],Response::HTTP_OK);
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
    public function edit(Request $request)
    {
        $job = Job::find($request->id);
        if($job){
            return response()->json(['jobs'=>$job],Response::HTTP_OK);
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
        $job = Job::find($request->id);
        DB::beginTransaction();
        try {
            $job->title = $request->title;
            $job->start_date = $request->start_date;
            $job->end_date = $request->end_date;
            $job->position = $request->position;
            $job->salary = $request->salary;
            $job->description = $request->description;
            $job->location = $request->location;
            $job->count = (int)$request->count;
            $job->province = (int)$request->province;
            $job->district = (int)$request->district;
            $job->ward = (int)$request->ward;
            $job->required = $request->required;
            $job->type_id = (int)$request->type;
            $job->experience_id = (int)$request->experience;
            $job->language_id = (int)$request->language;
            $job->status = 0;
            $job->active = 0;

            $job->save();
            DB::commit();
            return response()->json(Response::HTTP_OK);

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
