<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Subject;
use Validator;


class examController extends Controller
{
    public function examLoad()
    {
        $subjectList = Subject::all();
        return view('admin.exam',['subjectList'=>$subjectList]);
    }
    public function addExam(Request $req)
    {
        
        try{
            $validate = Validator::make($req->all(),[
                'exam_name'=>'required|string|min:3|max:30',
                'subject' =>'required',
                'date' => 'required',
                'time' => 'required'
            ]);

            if(!$validate->fail()){
                
                 Exam::create([
                    'exam_name' => $req->exam_name,
                    'subject_id' => $req->subject,
                    'date' => $req->date,
                    'time' => $req->time
                ]);
                return response()->json([
                    'success' => false,
                    'msg' => 'Create new exam successfully'
                ]);
            }

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }


    public function examList()
    {
        try{
            $exam = new Exam();
            $examList = $exam->all();
            return response()->json($examList);
        }
        catch(\Exception $e){
            return response()->json($e->getMessage());
        }
    }

    public function deleteExam($id)
    {
        try{
            Exam::where('id',$id)->delete();
            return response()->json(['success'=>true]);

        }catch(\Exception $e){
            return response()->json(['success'=>false]);
        }

    }

    public function editExam($id)
    {
        try{

            $exam = new Exam();
            $examData = $exam->find($id);
            return response()->json($examData);

        }catch(\Exception $e){
            return response()->json($e->getMessage());
        }
    }
}
