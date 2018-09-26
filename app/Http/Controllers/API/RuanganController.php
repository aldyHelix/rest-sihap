<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Ruangan;
class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexlist()
    {
        $dataruangan = \App\Ruangan::all();

        if(count($dataruangan)>0){
            $res['message'] = "Success! data Available";
            $res['values'] = $dataruangan;
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
            'ruangan_id' => 'required|integer',
            'ruangan_name' => 'required',
            'lantai_ruangan' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $dataruangan = $request->all();

        $checkid = \App\Ruangan::where('ruangan_id', $dataruangan['ruangan_id'])->count();

        if(($checkid) == 1){
            return response()->json(['ERROR'=>'DUPLICATE DATA ENTRY!']);
        }
        else{
            if(Ruangan::create($dataruangan)){
                $res['message'] = "Success Data Entry!";
                $res['value'] = $dataruangan;               
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
        $dataruangan = \App\Ruangan::where('ruangan_id', $id)->get();

        if(count($dataruangan) > 0){
            $res['message'] = "Success!";
            $res['values'] = $dataruangan;
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
            'ruangan_id' => 'required|integer',
            'ruangan_name' => 'required',
            'lantai_ruangan' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $dataruangan = $request->all();

        $checkid = \App\Ruangan::where('ruangan_id', $dataruangan['ruangan_id'])->count();

        if(($checkid) == 1){
            $res['available'] = "Data found!";
            $updatedata = Ruangan::findOrfail($id);
            $updatedata->update($dataruangan);
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
        $dataruangan = \App\Ruangan::where('ruangan_id', $id)->first();

        if($dataruangan->delete()){
            $res['message'] = "Data Deleted!";
            $res['value'] = $dataruangan;
            return response($res);
        }
        else{
            $res['message'] = "ERROR DELETE DATA! recheck NIP!";
            return response($res);
        }
    }
}
