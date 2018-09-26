<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datacatatan = \App\Catatan_harian::all();

        if(count($datacatatan)>0){
            $res['message'] = "Success! data Available";
            $res['values'] = $datacatatan;
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
            'catatan_nip' => 'required|integer',
            'catatan_description' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $datacatatan = $request->all();

        $checkid = \App\Catatan_harian::where('catatan_nip', $datacatatan['catatan_nip'])->count();

        if(($checkid) == 1){
            return response()->json(['ERROR'=>'DUPLICATE DATA ENTRY!']);
        }
        else{
            if(Catatan_harian::create($datacatatan)){
                $res['message'] = "Success Data Entry!";
                $res['value'] = $datacatatan;               
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
    public function show($nip)
    {
        $datacatatan = \App\Catatan_harian::where('catatan_nip', $nip)->get();

        if(count($datacatatan) > 0){
            $res['message'] = "Success!";
            $res['values'] = $datacatatan;
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
            'catatan_nip' => 'required|integer',
            'catatan_description' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $datacatatan = $request->all();

        $checkid = \App\Catatan_harian::where('catatan_id', $id)->count();

        if(($checkid) == 1){
            $res['available'] = "Data found!";
            $updatedata = Catatan_harian::findOrfail($id);
            $updatedata->update($datacatatan);
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
        $datacatatan = \App\Catatan_harian::where('catatan_id', $id)->first();

        if($datacatatan->delete()){
            $res['message'] = "Data Deleted!";
            $res['value'] = $datacatatan;
            return response($res);
        }
        else{
            $res['message'] = "ERROR DELETE DATA! recheck ID!";
            return response($res);
        }
    }
}
