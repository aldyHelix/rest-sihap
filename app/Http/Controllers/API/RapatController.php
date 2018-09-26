<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RapatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = \App\Rapat::all();

        if(count($data) > 0){
            $res['message'] = "Success!, menampilkan data Kegiatan";
            $res['list'] = $data;

            return response($res);
        }
        else{
            $res['message'] = "No Data Entry!";
            return response($res);
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
        $validator = Validator::make($request->all(), [
            'rapat_id' => 'required|integer',
            'rapat_name' => 'required',
            'rapat_desc' => 'required',
            'rapat_loc',
            'rapat_time'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $data = $request->all();

        $checkid = \App\Rapat::where('rapat_id', $data['rapat_id'])->count();

        if(($checkid) == 1){
            return response()->json(['ERROR'=>'DUPLICATE DATA ENTRY!']);
        }
        else{
            if(Rapat::create($data)){
                $res['message'] = "Success Data Entry!";
                $res['value'] = $data;               
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
        $data = \App\Rapat::where('rapat_id', $id)->get();

        if(count($data) > 0){
            $res['message'] = "Success!";
            $res['values'] = $data;
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
            'rapat_id' => 'required|integer',
            'rapat_name' => 'required',
            'rapat_desc' => 'required',
            'rapat_loc',
            'rapat_time'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $data = $request->all();

        $checkid = \App\Rapat::where('rapat_id', $data['rapat_id'])->count();
        
        if(($checknip) == 1){
            $res['available'] = "Data found!";
            $updatedata = Rapat::findOrfail($id);
            $updatedata->update($data);
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
        $data = \App\Rapat::where('Rapat_id', $id)->first();

        if($data->delete()){
            $res['message'] = "Data Deleted!";
            $res['value'] = $data;
            return response($res);
        }
        else{
            $res['message'] = "ERROR DELETE DATA! recheck NIP!";
            return response($res);
        }
    }
}
