<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;
use DB;
use Validator;
use App\Mark;
class SubjectController extends Controller
{
    /*
    *rendering all the subjects for the selected course
    */
    public function getSubject(Request $request){
        $semester_id=$request->semester_id;
        $subject=Subject::where('semester_id','=',$semester_id)->get();
        return response()->json($subject);
        // return response()->json($semester_id);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
                /*$subject=Subject::all();*/

        $subject=DB::table('subjects')
                ->join('semesters','semesters.id','=','subjects.semester_id')
                ->join('courses','courses.id','=','subjects.course_id')
                ->select('subjects.*','semesters.semester','courses.course_name')
                ->get();
        /*echo "<pre>";        
        print_r($subject);
        exit;*/

        return view('crud.admin.subjects')->with('subject',$subject);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'course'=>'required',
            'semester'=>'required',
            'subject'=>'required|unique:subjects,subject'
            ]);
        if($validator->passes()){
            $subject=Subject::where('subject','=',$request->subject)
                            ->where('semester_id','=',$request->semester)
                            ->where('course_id','=',$request->course)
                            ->get();
            if($subject->count()){
                return response()->json(404);//subject with same name, semester and course already exist
            }
            $subject=new Subject;
            $subject->subject=$request->subject;
            $subject->course_id=$request->course;
            $subject->semester_id=$request->semester;
            if($subject->save()){
                $subject_data=DB::table('subjects')
                                ->join('courses','courses.id','=','subjects.course_id')
                                ->join('semesters','semesters.id','=','subjects.semester_id')
                                ->select('courses.course_name','semesters.semester','subjects.*')
                                ->orderBy('subjects.id','desc')
                                ->first();
                return response()->json($subject_data);
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
         
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        
        $subject=DB::table('subjects')
                ->join('semesters','semesters.id','=','subjects.semester_id')
                ->select('subjects.*','semesters.semester')
                ->where('subjects.id','=',$id)
                ->get();
        // echo "<pre>";
        // print_r($subject[0]);
        // exit;
        return view('crud.admin.updateSubject')->with('data',$subject[0]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'id'=>'required',
            'subject'=>'required|string|max:50',
            'course'=>'required',
            'semester'=>'required'
            ]);
        if($validator->passes()){
            $subject=Subject::where('subject','=',$request->subject)
                            ->where('course_id','=',$request->course)
                            ->where('semester_id','=',$request->semester)
                            ->get();
            if($subject->count()){
                return response()->json(401);//subject with same course and semester already exist
            }
            else{
                $subject =Subject::find($request->id);
                $subject->subject=$request->subject;
                $subject->course_id=$request->course;
                $subject->semester_id=$request->semester;
                if($subject->save()){
                    $subject_data=DB::table('subjects')
                            ->join('courses','courses.id','=','subjects.course_id')
                            ->join('semesters','semesters.id','=','subjects.semester_id')
                            ->select('courses.course_name','semesters.semester','subjects.*')
                            ->where('subjects.id','=',$request->id)
                            ->get();

                    return response()->json($subject_data);//success
                }else{
                    return response()->json(402);//unknown error occurred
                }
            }
        }else{
            return response()->json(404);//subject name, course and semester are required
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        $marks=Mark::where('subject_id','=',$request->id)->get();
        if($marks->count()){
            return response()->json(404);//subject already exist in marks table
        }
        else{
            $subject_data=Subject::find($request->id)->delete();
            return response()->json(200);//subject deleted successfully
        }
    }
}
