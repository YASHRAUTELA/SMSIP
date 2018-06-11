<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use DB;
use App\Mark;
use App\Subject;
use App\Student;
use App\Semester;
use Validator;
class CourseController extends Controller
{
    public function getUsedCourse(){
        $result=DB::table('courses')
                ->whereIn('id',function ($query) {
                                $query->select(DB::raw('course_id'))
                                  ->from('semesters')
                                  ->whereRaw('semesters.course_id = courses.id');
                            })
                ->get();
        return response()->json($result);
    }

    public function getNotUsedCourse(){
        $result=DB::table('courses')
                ->whereNotIn('id',function ($query) {
                                $query->select(DB::raw('course_id'))
                                  ->from('semesters')
                                  ->whereRaw('semesters.course_id = courses.id');
                            })
                ->get();
        return response()->json($result);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course_data=Course::all();

        return view('crud.course')->with('data',$course_data);
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
                'course' => 'required',
                'duration'=>'required'
            ]);
            
        if($validator->passes()){
            $course=Course::where('course_name','=',$request->course)->get();
            if($course->count()){
                return response()->json(404);//if course name already exist
            }else{
                $data = new Course;
                $data->course_name = $request->course;
                $data->duration=$request->duration;
                $data->save();
                return response()->json ($data);    
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the Course data.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'course'=>'required',
            'duration'=>'required'
            ]);

        if($validator->passes()){
            $course=Course::where('course_name','=',$request->course)->get();
            if($course->count()){
                return response()->json(401);//course name already exist
            }
            $data=Course::find($request->id);
            $data->course_name=$request->course;
            $data->duration=$request->duration;
            $data->save();
            return response()->json($data);
        }
        else{
            return response()->json(404);//course name and duration required
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $marks=Mark::where('course_id','=',$request->id)->get();
        $semester=Semester::where('course_id','=',$request->id)->get();
        $student=Student::where('course_id','=',$request->id)->get();
        $subject=Subject::where('course_id','=',$request->id)->get();

        if($marks->count()){
            return response()->json(401);//course exists in marks table
        }
        elseif($semester->count()){
            return response()->json(402);//course exists in semester table
        }
        elseif($student->count()){
            return response()->json(403);//course exists in student table
        }
        elseif($subject->count()){
            return response()->json(404);//course exists in subject table
        }
        else{
            Course::find($request->id)->delete();
            return response()->json(200);    
        }
        
    }
}
