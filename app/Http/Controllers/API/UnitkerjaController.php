<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use App\Unitkerja;

class UnitkerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexlist()
    {
        $dataunitkerja = \App\Unitkerja::all();

        if(count($dataunitkerja)>0){
            $res['message'] = "Success! data Available";
            $res['values'] = $dataunitkerja;
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
            'unitkerja_id' => 'required|integer',
            'unitkerja_name' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $dataunitkerja = $request->all();

        $checkid = \App\Unitkerja::where('unitkerja_id', $dataunitkerja['unitkerja_id'])->count();

        if(($checkid) == 1){
            return response()->json(['ERROR'=>'DUPLICATE DATA ENTRY!']);
        }
        else{
            if(Unitkerja::create($dataunitkerja)){
                $res['message'] = "Success Data Entry!";
                $res['value'] = $dataunitkerja;               
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
        $dataunitkerja = \App\Unitkerja::where('unitkerja_id', $id)->get();

        if(count($dataunitkerja) > 0){
            $res['message'] = "Success!";
            $res['values'] = $dataunitkerja;
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
            'unitkerja_id' => 'required|integer',
            'unitkerja_name' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $dataunitkerja = $request->all();

        $checkid = \App\Unitkerja::where('unitkerja_id', $dataunitkerja['unitkerja_id'])->count();

        if(($checkid) == 1){
            $res['available'] = "Data found!";
            $updatedata = Unitkerja::findOrfail($id);
            $updatedata->update($dataunitkerja);
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
        $dataunitkerja = \App\Unitkerja::where('unitkerja_id', $id)->first();

        if($dataunitkerja->delete()){
            $res['message'] = "Data Deleted!";
            $res['value'] = $dataunitkerja;
            return response($res);
        }
        else{
            $res['message'] = "ERROR DELETE DATA! recheck NIP!";
            return response($res);
        }
    }
}
