<?php

namespace App\Http\Controllers;

use App\Semester;
use Illuminate\Http\Request;
use DB;
use App\Course;
use App\Subject;
class SemesterController extends Controller
{
    /*
    *Rendering the semester of the selected courses
    */
    public function getSemester(Request $request){
        $course_id=$request->course_id;
        $semester=Semester::where('course_id','=',$course_id)->get();
        return response()->json($semester);
        // return response()->json($course_id);
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
        $semester_data=DB::table('semesters')
                            ->join('courses','courses.id','=','semesters.course_id')
                            ->select('semesters.*','courses.course_name')
                            ->paginate(8);
        /*echo "<pre>";
        print_r($semester_data);
        exit;*/
        return view('crud.admin.semesters')->with('data',$semester_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $course_data=Course::find($request->course);
        
        $duration=$course_data->duration;
       
        $course_name=$course_data->course_name;
        
        for($i=1; $i<=(2*$duration); $i++){
            
            $b=$course_name."".$i;
            $t=str_replace(' ','',$b);

            $sem=new Semester;
            $sem->semester=$t;
            $sem->course_id=$request->course;
            $sem->save();
        }
        return redirect()->back()->with('success','Semesters added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function show(Semester $semester)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function edit(Semester $semester)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Semester $semester)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $semester_data=Semester::where('course_id','=',$request->course)->get();
        
        foreach($semester_data as $data)
        {

            $subject_data=Subject::where('semester_id','=',$data->id)->get();

            if($subject_data->count()){
                return redirect()->back()->with('error','data cannot be deleted because of foreign key constraint');
            }
        }
       $semester_data=Semester::where('course_id','=',$request->course)->delete();
        return redirect()->back()->with('success','data deleted successfully');
    }
}
