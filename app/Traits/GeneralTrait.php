<?php


namespace App\Traits;


Trait GeneralTrait
{
public function sendResponse($result,$message){
    $response=[
        'success'=>'true',
       'data'=>$result,
        'message'=>$message
    ];
    return response()->json($response,200);

}
    public function sendError($error,$errormessage=[],$code=404){
        $response=[
            'success'=>'false',
            'message'=>$error
        ];
        if(!empty($errormessage)){
            $response['data']=$errormessage;
        }
        return response()->json($response,$code);

    }
    public function success($message,$id=null){
    $success=[
        'statue'=>'true',
        'message'=>$message,

    ];
    if($id!==null){
        $success['id']=$id;
    }
    return response()->json($success);

    }
    public function errors($message){
        $fails=[
            'statue'=>'false',
            'message'=>$message
        ];
        return response()->json($fails);

    }

}
