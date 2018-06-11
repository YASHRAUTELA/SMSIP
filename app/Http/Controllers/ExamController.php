<?php

namespace App\Http\Controllers;

use App\Exam;
use Illuminate\Http\Request;
use App\Mark;
use Validator;
class ExamController extends Controller
{
    
    public function getExam(){
        $exam=Exam::all();
        return response()->json($exam);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exam=Exam::all();
        return view('crud.admin.exams')->with('exams',$exam);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'exam'=>'required'
            ]);

        if($validator->passes()){
            $exam=Exam::where('exam','=',$request->exam)->get();
            if($exam->count()){
                return response()->json(404);
            }else{
                $exam=new Exam;
                $exam->exam=$request->exam;
                if($exam->save()){
                    return response()->json($exam);
                }
            }    
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'exam'=>'required',
            ]);

        if($validator->passes()){
            $exam=Exam::where('exam','=',$request->exam)->get();
            if($exam->count()){
                return response()->json(401);//exam name already exist
            }
            $exam_data=Exam::find($request->id);
            $exam_data->exam=$request->exam;
            $exam_data->save();
            return response()->json($exam_data);    
        }else{
            return response()->json(404);//exam name is required
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //not in use now
        $data=$request->validate([
            'id'=>'required',
            'exam'=>'required'
            ]);

        $exam=Exam::where('exam','=',$request->exam)->get();
        if($exam->count()){
            return redirect()->back()->with('update_failure','previous and updated data should not be same');
            
        }else{
            $exam=Exam::find($request->id);
            $exam->exam=$request->exam;
            if($exam->save()){
                return redirect()->route('exams')->with('success','exam updated successfully');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->id;
        $marks=Mark::where('exam_id','=',$id)->get();
        if($marks->count()){
            return response()->json(404);//exam name already exist in marks table
        }else{
            $exam=Exam::find($id)->delete();
            return response()->json(200);
        }
    }
}
