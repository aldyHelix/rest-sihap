<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use App\Jabatan;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexlist()
    {
        $datajabatan = \App\Jabatan::all();

        if(count($datajabatan)>0){
            $res['message'] = "Success! data Available";
            $res['values'] = $datajabatan;
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
            'jabatan_id' => 'required|integer',
            'jabatan_name' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $datajabatan = $request->all();

        $checkid = \App\Jabatan::where('jabatan_id', $datajabatan['jabatan_id'])->count();

        if(($checkid) == 1){
            return response()->json(['ERROR'=>'DUPLICATE DATA ENTRY!']);
        }
        else{
            if(Jabatan::create($datajabatan)){
                $res['message'] = "Success Data Entry!";
                $res['value'] = $datajabatan;               
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
        $datajabatan = \App\Jabatan::where('jabatan_id', $id)->get();

        if(count($datajabatan) > 0){
            $res['message'] = "Success!";
            $res['values'] = $datajabatan;
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
            'jabatan_id' => 'required|integer',
            'jabatan_name' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $datajabatan = $request->all();

        $checkid = \App\Jabatan::where('jabatan_id', $datajabatan['jabatan_id'])->count();

        if(($checkid) == 1){
            $res['available'] = "Data found!";
            $updatedata = Jabatan::findOrfail($id);
            $updatedata->update($datajabatan);
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
        $datajabatan = \App\Jabatan::where('jabatan_id', $id)->first();

        if($datajabatan->delete()){
            $res['message'] = "Data Deleted!";
            $res['value'] = $datajabatan;
            return response($res);
        }
        else{
            $res['message'] = "ERROR DELETE DATA! recheck NIP!";
            return response($res);
        }
    }
}
