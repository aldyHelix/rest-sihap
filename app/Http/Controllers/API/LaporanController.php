<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = \App\Laporan::all();

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
            'laporan_id', 
            'peg_nip' => 'required|integer',
            'penilaian_id' => 'required',
            'is_kirim' ,
            'laporan_kirim',
            'is_persetujuan',
            'laporan_persetujuan'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $data = $request->all();

        $checkid = \App\Laporan::where('laporan_id', $data['laporan_id'])->count();

        if(($checkid) == 1){
            return response()->json(['ERROR'=>'DUPLICATE DATA ENTRY!']);
        }
        else{
            if(Laporan::create($data)){
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
        $data = \App\Laporan::where('laporan_id', $id)->get();

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
            'laporan_id', 
            'peg_nip' => 'required|integer',
            'penilaian_id' => 'required',
            'is_kirim' ,
            'laporan_kirim',
            'is_persetujuan',
            'laporan_persetujuan'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $data = $request->all();

        $checkid = \App\Laporan::where('laporan_id', $data['laporan_id'])->count();
        
        if(($checknip) == 1){
            $res['available'] = "Data found!";
            $updatedata = Laporan::findOrfail($id);
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
        $data = \App\Laporan::where('laporan_id', $id)->first();

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