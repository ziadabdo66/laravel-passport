<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use Validator;

class RegisterController extends Controller
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
      $input=$request->all();
      $input['password']=bcrypt($input['password']);
      $user=User::create($input);
      $success['success_token']=$user->createToken('MyApp')->accessToken;
      $success['name']=$user->name;
       return $this->sendResponse($success,'user is created');


   }
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth('web')->attempt($credentials)) {
            $sucsess['token'] = auth('web')->user()->createToken('MyApp')->accessToken;
            return $this->sendResponse($sucsess, 200);
        } else {
            return $this->sendError(['error' => 'UnAuthorised'], 401);
        }
    }
}
