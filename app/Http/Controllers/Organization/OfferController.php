<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $offers = DB::table('offers')
        ->join('users', 'offers.user_id', '=', 'users.id')
        ->join('organizations', 'offers.organization_id', '=', 'organizations.id')
        ->where('offers.user_id',$request->user_id)
        ->select('offers.*', 'organizations.image', 'organizations.fullname')
        ->get();
        if($offers){
            return response()->json(['offers' => $offers],Response::HTTP_OK);
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
            $offer = new Offer();
            $offer->user_id = $request->user_id;
            $offer->organization_id = $request->organization_id;
            $offer->message = $request->message;
            if ($request->has('file')) {
                $file =  $request->file('file');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $request->file->move(public_path("/upload/offer"), $fileName);
                $offer->file = "/upload/offer" . "/" . $fileName;
            }
            $offer->save();
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
    public function update(Request $request, $id)
    {
        //
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
