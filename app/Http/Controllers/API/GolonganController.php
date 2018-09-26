<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use App\Golongan;

class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexlist()
    {
        $datagolongan = \App\Golongan::all();

        if(count($datagolongan)>0){
            $res['message'] = "Success! data Available";
            $res['values'] = $datagolongan;
        }
        else{
            $res['message'] = "No Data!";
        }
        return response($res);
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
        $validator = Validator::make($request->all(), [
            'golongan_id' => 'required|integer',
            'golongan_name' => 'required',
            'golongan_details' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $datagolongan = $request->all();

        $checkid = \App\Golongan::where('golongan_id', $datagolongan['golongan_id'])->count();

        if(($checkid) == 1){
            return response()->json(['ERROR'=>'DUPLICATE DATA ENTRY!']);
        }
        else{
            if(Golongan::create($datagolongan)){
                $res['message'] = "Success Data Entry!";
                $res['value'] = $datagolongan;               
            }
            else{
                $res['error'] = "ERROR INPUT!";
            }    
        return response($res);
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
        $datagolongan = \App\Golongan::where('golongan_id', $id)->get();

        if(count($datagolongan) > 0){
            $res['message'] = "Success!";
            $res['values'] = $datagolongan;
        } 
        else{
            $res['message'] = "No Data!";
        }
        
        return response($res);
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
        $validator = Validator::make($request->all(), [
            'golongan_id' => 'required|integer',
            'golongan_name' => 'required',
            'golongan_details' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $datagolongan = $request->all();

        $checkid = \App\Golongan::where('golongan_id', $datagolongan['golongan_id'])->count();

        if(($checkid) == 1){
            $res['available'] = "Data found!";
            $updatedata = Golongan::findOrfail($id);
            $updatedata->update($datagolongan);
            $res['message'] = "Success Data Updates";
            $res['value'] = $updatedata;
        }
        else{   
            $res['error'] = "ERROR INPUT! DATA NOT FOUND";
        }
        return response($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datagolongan = \App\Golongan::where('golongan_id', $id)->first();

        if($datagolongan->delete()){
            $res['message'] = "Data Deleted!";
            $res['value'] = $datagolongan;
            return response($res);
        }
        else{
            $res['message'] = "ERROR DELETE DATA! recheck NIP!";
            return response($res);
        }
    }
}
