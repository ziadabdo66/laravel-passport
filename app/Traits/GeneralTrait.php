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
}
