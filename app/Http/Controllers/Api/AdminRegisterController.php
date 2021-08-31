<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Admin;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use Validator;

class AdminRegisterController extends Controller
{
    use GeneralTrait;
   public function register(Request $request){
      $validate=Validator::make($request->all(),[
          'name'=>'required|string',
          'email'=>'email|required',
          'password'=>'required',
      ]);
      if($validate->fails()){
          return $this->sendError('error validate',$validate->errors());
      }
//      $input=$request->all();
//      $input['password']=bcrypt($input['password']);
       $request->merge(['password' => $request->password]);
      $admin=Admin::create($request->all());

      $token =  $admin->createToken('MyApp')->accessToken;

       return $this->sendResponse([$admin,$token],'user is created');


   }
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth('admin')->attempt($credentials)) {
           $sucsess['token'] = auth('admin')->user()->createToken('MyApp')->accessToken;
            return $this->sendResponse($sucsess, 200);
        } else {
            return $this->sendError(['error' => 'UnAuthorised'], 401);
        }
    }

}
