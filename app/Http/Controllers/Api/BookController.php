<?php

namespace App\Http\Controllers\Api;

use App\Admin;
use App\Book;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;

class BookController extends Controller
{
    use GeneralTrait;
    public function index(){
        $books=Book::get();
        return $this->sendResponse($books,'books');

    }
   public function create_book(Request $request){
      $validate=Validator::make($request->all(),[
          'name'=>'required|string',
          'details'=>'required',
      ]);
      if($validate->fails()){
          return $this->sendError('error validate',$validate->errors());
      }
      $input=$request->all();
      $book=Book::create($input);

       return $this->sendResponse($book->toArray,'book is created');


   }
   public function show($id){
       $book=Book::find($id);
       if(!$book) {
           return $this->sendError('book not found ');
       }
       return $this->sendResponse($book->toArray,'book read successfully');
   }
   public function delete($id){
       $book=Book::find($id);
       if(!$book) {
           return $this->sendError('book not found ');
       }
       $book->delete();
       return $this->sendResponse($book->toArray,'book delete successfully');
   }
    public function update(Request $request){
        $book=Book::find($request->id);
        if(!$book) {
            return $this->sendError('book not found ');
        }

        $validate=Validator::make($request->all(),[
            'name'=>'required|string',
            'details'=>'required',
        ]);
        if($validate->fails()){
            return $this->sendError('error validate',$validate->errors());
        }
        $input=$request->all();
        $book=Book::update($input);

        return $this->sendResponse($book->toArray,'book is updated');


    }
    public function user_book(Request $request){
        $admin=auth('Admin-api')->user()->id;
        $admin=Admin::find($admin);
        foreach ($request->book_id as $book) {
             $admin->books()->attach($book);
        }
        return $this->sendResponse($admin,'userbook is created');
    }

}
