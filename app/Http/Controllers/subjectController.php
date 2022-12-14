<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use Validator;

class subjectController extends Controller
{
    public function subjectLoad()
    {
        return view('admin.subject');
    }
    public function subjectList(){
        try{
            $subject = new Subject();
            $list = $subject->all();

            return response()->json($list);

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'msg' => $e.getMessage()
            ]);
        }
    }

    public function addSubject(Request $req)
    {
        try{
            $validate = Validator::make($req->all(),[
                'subject' => 'required|min:2|max:30|string'
            ]);

            if(!$validate->fails()){

                Subject::insert([
                    'subject' => $req->subject
                ]);
                return response()->json([
                    'success'=>true,
                    'msg'=>'New Subject Added Successfully!!'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'success'=>false,
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function deleteSubject($id)
    {
        try{

           Subject::where('id',$id)->delete();
           return response()->json([
            'success'=>true
           ]);

        }catch(\Exception $e){
            return response()->json([
                'success'=>false,
                'msg' => 'Somthing is wrong'
            ]);
        }
    }
}
