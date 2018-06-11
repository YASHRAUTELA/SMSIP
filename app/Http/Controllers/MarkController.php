<?php

namespace App\Http\Controllers;

use App\Mark;
use Illuminate\Http\Request;
use DB;
use Auth;
use Validator;
class MarkController extends Controller
{

    public function getResult(Request $request){
        $data=$request->validate([
            'exam'=>'required',
            'semester'=>'required'
            ]);

        $marks= DB::table('marks')
                    ->join('students','students.id','=','marks.student_id')
                    ->join('exams','exams.id','=','marks.exam_id')
                    ->join('courses','courses.id','=','marks.course_id')
                    ->join('semesters','semesters.id','=','marks.semester_id')
                    ->join('users','users.id','=','students.user_id')
                    ->join('subjects','subjects.id','=','marks.subject_id')
                    ->select('subjects.subject','marks.obtained_marks','marks.total_marks')
                    ->where('exams.id','=',$request->exam)
                    ->where('semesters.id','=',$request->semester)
                    ->where('users.id','=',Auth::user()->id)
                    ->get();
        
        // echo "<pre>";
        // print_r($marks);
        // exit;
        if($marks->count()){
            return view('student.displayMarks')->with('marks',$marks);    
        }else{
            return redirect()->route('noMarks');
        }
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marks=DB::table('marks')
            ->join('students','students.id','=','marks.student_id')
            ->join('courses','courses.id','=','marks.course_id')
            ->join('semesters','semesters.id','=','marks.semester_id')
            ->join('subjects','subjects.id','=','marks.subject_id')
            ->join('exams','exams.id','=','marks.exam_id')
            ->join('users','users.id','=','students.user_id')
            ->select('marks.*','users.name','courses.course_name','semesters.semester','subjects.subject','exams.exam')
            ->get();
        
        return view('crud.admin.marks')->with('marks',$marks);
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
            'student_id'=>'required',
            'course_id'=>'required',
            'semester_id'=>'required',
            'subject_id'=>'required',
            'exam_id'=>'required',
            'obtained_marks'=>'required|integer|max:100',
            'total_marks'=>'required|integer|max:100'
            ]);
        
        if($validator->passes()){
            $marks_data=Mark::where('student_id','=',$request->student_id)
                        ->where('course_id','=',$request->course_id)
                        ->where('semester_id','=',$request->semester_id)
                        ->where('subject_id','=',$request->subject_id)
                        ->where('exam_id','=',$request->exam_id)
                        ->get();    
            if($marks_data->count()){
                return response()->json(401);//marks with same details already exist
            }
            else{
                $marks=new Mark;
                $marks->student_id=$request->student_id;
                $marks->course_id=$request->course_id;
                $marks->semester_id=$request->semester_id;
                $marks->subject_id=$request->subject_id;
                $marks->exam_id=$request->exam_id;
                $marks->obtained_marks=$request->obtained_marks;
                $marks->total_marks=$request->total_marks;
                if($marks->save()){
                    $mark_data=DB::table('marks')
                                ->join('students','students.id','=','marks.student_id')
                                ->join('courses','courses.id','=','marks.course_id')
                                ->join('semesters','semesters.id','=','marks.semester_id')
                                ->join('subjects','subjects.id','=','marks.subject_id')
                                ->join('exams','exams.id','=','marks.exam_id')
                                ->join('users','users.id','=','students.user_id')
                                ->select('marks.*','users.name','courses.course_name','semesters.semester','subjects.subject','exams.exam')
                                ->orderBy('marks.id','desc')
                                ->first();
                    return response()->json($mark_data);
                }else{
                    return response()->json(402);//unknown error occurred
                }
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function show(Mark $mark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marks=DB::table('marks')
            ->join('students','students.id','=','marks.student_id')
            ->join('courses','courses.id','=','marks.course_id')
            ->join('semesters','semesters.id','=','marks.semester_id')
            ->join('subjects','subjects.id','=','marks.subject_id')
            ->join('exams','exams.id','=','marks.exam_id')
            ->join('users','users.id','=','students.user_id')
            ->select('marks.*','users.name','courses.course_name','semesters.semester','subjects.subject','exams.exam')
            ->where('marks.id','=',$id)
            ->get();
        
        return view('crud.admin.updateMarks')->with('data',$marks[0]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'id'=>'required',
            'student_id'=>'required',
            'course_id'=>'required',
            'semester_id'=>'required',
            'subject_id'=>'required',
            'exam_id'=>'required',
            'obtained_marks'=>'required',
            'total_marks'=>'required',
            ]);

        if($validator->passes()){
            $mark_data=Mark::where('obtained_marks','=',$request->obtained_marks)
                            ->where('total_marks','=',$request->total_marks)
                            ->get();
            if($mark_data->count()){
                return response()->json(402);//obtained and total_marks are already exist
            }

            $mark=Mark::find($request->id);
            $mark->obtained_marks=$request->obtained_marks;
            $mark->total_marks=$request->total_marks;
            if($mark->save()){
                $mark_data=DB::table('marks')
                        ->join('students','students.id','=','marks.student_id')
                        ->join('courses','courses.id','=','marks.course_id')
                        ->join('semesters','semesters.id','=','marks.semester_id')
                        ->join('subjects','subjects.id','=','marks.subject_id')
                        ->join('exams','exams.id','=','marks.exam_id')
                        ->join('users','users.id','=','students.user_id')
                        ->select('marks.*','users.name','courses.course_name','semesters.semester','subjects.subject','exams.exam')
                        ->where('marks.id','=',$request->id)
                        ->first();

                return response()->json($mark_data);//success and updated data returned
            }
            else{
                return response()->json(401);//an unknown error occurred
            }
        }
        else{
            return response()->json(404);//obtained and total marks are required
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $mark=Mark::find($request->id)->delete();
        return response()->json(200);
    }
}
