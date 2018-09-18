<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Carbon\Carbon;

class UserController extends Controller
{

    public function list(){
        $data = \App\User::all(['name', 'user_nip', 'email']);

        if(count($data)>0){
            $res['message'] = "Success! Show All Data below";
            $res['values'] = $data;

            return response($res);
        }
        else{
            return response()->json(['message'=>'No Data Entry!']);
        }
    }

    public $successStatus = 200;

    public function login(Request $request){
        $request->validate([
            'user_nip' => 'required|integer',
            'password' => 'required'
        ]);

        $credentials = request(['user_nip', 'password']);

        if(!Auth::attempt($credentials)){
            return response()->json(['error'=>'Unauthorised'], 401);
        }
        else{
            
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;

            $token->save();

            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expire_at' => Carbon::parse(
                    $tokenResult->token->expire_at
                )->toDateTimeString()
            ]);
        }
    }

    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json(['message'=>'Successfully Logged out']);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'user_nip' => 'required|integer',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('nApp')->accessToken;
        $success['name'] =  $user->name;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function details(Request $request)
    {
        $user = $request->user();
        //return response()->json(['success' => $user], $this->successStatus);

        if($user['level_hak_akses']=='5'){
            $res['message'] = "Success, User Seorang Pegawai!";
            $res['success'] = $user;

            return response($res);
        }
        else{
            $res['message'] = "Success, User Seorang Pegawai!";
            $res['success'] = $user;

            return response($res);
        }
    }
}