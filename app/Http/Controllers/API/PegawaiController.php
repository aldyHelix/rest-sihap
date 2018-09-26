<?php

namespace App\Http\Controllers\API;
use App\Pegawai;
use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

//use App\Http\Resources\PegawaiResource;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexlist()
    {
        //
        $data = \App\Pegawai::all();

        if(count($data) > 0){
            $res['message'] = "Success!, Menampilkan data Pegawai";
            $res['list'] = $data;

            return response($res);
        }
        else{
            $res['message'] = "No Data Entry!";
            return response($res);
        }
    }

    public function inputtouser(){
        //for create both on user and pegawai
        //generate password : 123456
        //current hak_akses : 5
        //create on nama (tanpa gelar ) dan nip
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
        $password = password_hash('123456', PASSWORD_BCRYPT);
        $datauser = new \App\User();
        $validator = Validator::make($request->all(), [
            'nip' => 'required|integer',
            'nama' => 'required',
            'email' => 'required|email',
            'gelar_depan',
            'gelar_belakang',
            'jabatan_id',
            'golongan_id',
            'atasan_nip'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $datapeg = $request->all();

        $datauser->user_nip = $datapeg['nip'];
        $datauser->name = $datapeg['nama'];
        $datauser->email = $datapeg['email'];
        $datauser->password = $password;

        $checknip = \App\User::where('user_nip', $datapeg['nip'])->count();
        $checkemail = \App\User::where('email', $datapeg['email'])->count();
        
        if(($checknip || $checkemail) == 1){
            return response()->json(['ERROR'=>'DUPLICATE DATA ENTRY!']);
        }
        else{
            if(Pegawai::create($datapeg)){
                $res['pegawaimodelmessage'] = "Success Data Entry!";
                $res['value'] = $datapeg;
                
                if($datauser->save()){
                    $res['usermodelmessage'] = "USER DATA CREATED! ";
                    $res['userval'] = $datauser;
                    $res['feedback'] = $datauser->name;
                }
                else{
                    $res['error'] = "Error!";
                }
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
        
        $data = \App\Pegawai::where('nip', $nip)->get();
        $atasan_nip = $data[0]->atasan_nip;
        $data_atasan = \App\Pegawai::where('nip', $atasan_nip)->get();

        if(count($data)> 0){

            $res['message'] = "Sukses!";
            $res['data'] = $data;

            if(count($data_atasan)> 0){
                $res['atasan'] = $data_atasan;
            }
            else{
                $res['atasan'] = "Pegawai Tidak Memiliki Atasan";
            }
            return response($res);
        }
        else{
            $res['message'] = "NIP tidak terdaftar!";

            return response($res);
        }
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
            'nip' => 'required|integer',
            'nama' => 'required',
            'gelar_depan',
            'gelar_belakang',
            'jabatan_id',
            'golongan_id',
            'atasan_nip'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $datapeg = $request->all();

        $checknip = \App\Pegawai::where('nip', $datapeg['nip'])->count();
        
        if(($checknip) == 1){
            $res['available'] = "Data found!";
            $updatedata = Pegawai::findOrfail($id);
            $updatedata->update($datapeg);
            $res['pegawaimodelmessage'] = "Success Data Updates";
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
    public function destroy($nip)
    {
        $datapeg = \App\Pegawai::where('nip', $nip)->first();
        $datauser = \App\User::where('user_nip', $nip)->first();

        if($datapeg->delete()){
            $res['message'] = "Data Deleted!";
            $res['value'] = $datapeg;

            if($datauser->delete()){
                $res['messageuser'] = "User Data has been Deleted!";
                $res['userdata'] = $datauser;
            } else {
                $res['messageuser'] = "failed delete user data!";
            }

            return response($res);
        }
        else{
            $res['message'] = "ERROR DELETE DATA! recheck NIP!";
            return response($res);
        }
    }
}
