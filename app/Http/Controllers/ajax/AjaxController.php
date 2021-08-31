<?php

namespace App\Http\Controllers\ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormRequest;
use App\Http\Requests\userRequest;
use App\Tourism;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Traits\saveimages;
use Symfony\Component\VarDumper\Cloner\Data;



class AjaxController extends Controller
{
    use GeneralTrait;
    use saveimages;


    public function index(){
       // orderBy('id','Random')
        $tourisms=Tourism::inRandomOrder()->limit(5)->get();
        return view('index',compact('tourisms'));
    }
    public function create(){
        return view('create');
    }
    public function store(Request $request){
        $filename=$this->saveimage($request->photo,'tourism');
        $tourism =Tourism::firstOrCreate([
                'email'=>$request->email,


            ]

        );
     /*   $tourism=Tourism::create([
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'username'=>$request->username,
            'city'=>$request->city,
            'photo'=>$filename
        ]);*/
        if(!$tourism){
       return     $this->errors('هذه الداتا غير موجوده');
        }
        else{
            return     $this->success('تم الاضافه بنجاح');
        }


    }
    public function delete(Request $request){
        $tourism=Tourism::findOrFail($request->id);
        $tourism=$tourism->delete();
        if ($tourism){
            return     $this->success('تم الحذف بنجاح',$request->id);
        } else
            {
            return     $this->errors('لم يتم الحذف');
        }

    }
    public function updates($id){
        $tourism=Tourism::find($id);
        return view('createEdit',compact('tourism'));
    }

    public function edit(Request $request){
        $filename=$this->saveimage($request->photo,'tourism');
        $validate=Validator::make($request->all(),[
            'name'=>['required',function($attribute,$value,$fail){
            if ($value == "mo"){
                $fail('error');
            }
            }],
            'email'=>'email|required',
            'password'=>'required',
        ]);
        $tourism=Tourism::find($request->id);

        $tourism->update([
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'username'=>$request->username,
            'city'=>$request->city,
            'photo'=>$filename,

        ]);

        //carbon now() == touch() for created_at ==updated_at where update
        //Date('created_at')=cu

        if(!$tourism){
            return     $this->errors('هذه الداتا غير موجوده');
        }
        else{
            return     $this->success('تم التعديل بنجاح');
        }


    }
    public function duplicate($id){
        $tourism=Tourism::find($id);
        return view('createCopy',compact('tourism'));
    }
    public function Copy(Request $request){
    //    $filename=$this->saveimage($request->photo,'tourism');
        $tourism=Tourism::find($request->id);

    $tourism=    $tourism->replicate()->fill($request->all());
        $tourism->save();

        //carbon::now() == touch() for created_at ==updated_at where update
        //Date('created_at')=cu

        if(!$tourism){
            return     $this->errors('هذه الداتا غير موجوده');
        }
        else{
            return     $this->success('تم التعديل بنجاح');
        }


    }

}
