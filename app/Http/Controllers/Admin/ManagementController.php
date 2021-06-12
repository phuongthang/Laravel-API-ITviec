<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CV;
use App\Models\Job;
use App\Models\Organization;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ManagementController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listOrganization()
    {
        $organizations = Organization::where('flag_delete',1)->get();
        if($organizations){
            return response()->json(['organizations' => $organizations],Response::HTTP_OK);
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
    public function listUser()
    {
        $users = User::where('flag_delete',1)->get();
        if($users){
            return response()->json(['users' => $users],Response::HTTP_OK);
        }
        else{
            return response()->json(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function listJob()
    {
        $jobs = DB::table('jobs')
        ->join('organizations', 'jobs.organization_id', '=', 'organizations.id')
        ->where('jobs.flag_delete',1)
        ->select('jobs.*','organizations.id as organization_id', 'organizations.image', 'organizations.fullname')
        ->get();
        if($jobs){
            return response()->json(['jobs' => $jobs],Response::HTTP_OK);
        }
        else{
            return response()->json(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function listCV()
    {
        $cvs = DB::table('cvs')
        ->join('users', 'cvs.user_id', '=', 'users.id')
        ->where('cvs.flag_delete',1)
        ->select('cvs.*', 'users.image', 'users.fullname')
        ->get();
        if($cvs){
            return response()->json(['cvs' => $cvs],Response::HTTP_OK);
        }
        else{
            return response()->json(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function deleteOrganization(Request $request)
    {
        DB::beginTransaction();
        try {
            $organization = Organization::find($request->id);
            if($organization){
                $organization->flag_delete = 0;

                $organization->save();

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

    public function deleteUser(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::find($request->id);
            if($user){
                $user->flag_delete = 0;

                $user->save();

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

    public function deleteJob(Request $request)
    {
        DB::beginTransaction();
        try {
            $job = Job::find($request->id);
            if($job){
                $job->flag_delete = 0;

                $job->save();

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

    public function deleteCV(Request $request)
    {
        DB::beginTransaction();
        try {
            $cv = CV::find($request->id);
            if($cv){
                $cv->flag_delete = 0;

                $cv->save();

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

    public function activeJob(Request $request)
    {
        DB::beginTransaction();
        try {
            $job = Job::find($request->id);
            if($job){
                $job->active = $request->flag;

                $job->save();

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

    public function activeCV(Request $request)
    {
        DB::beginTransaction();
        try {
            $cv = CV::find($request->id);
            if($cv){
                $cv->active = $request->flag;

                $cv->save();

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
    public function activeOrganization(Request $request)
    {
        DB::beginTransaction();
        try {
            $job = Organization::find($request->id);
            if($job){
                $job->active = $request->flag;

                $job->save();

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
    public function activeStatusJob(Request $request)
    {
        DB::beginTransaction();
        try {
            $job = Job::find($request->id);
            if($job){
                $job->status = $request->flag;
                if($job->active === 1){
                    $job->active = 0;
                }

                $job->save();

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
}
