<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use Validator;
use App\Faculty;
class DepartmentController extends Controller
{
     public function getDepartment(){
        $department_data=Department::all();
        return response()->json($department_data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dept_data=Department::all();
        return view('crud.department')->with('data',$dept_data);
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
                'department' => 'required'
            ]);
        
        if($validator->passes()){
            $department=Department::where('department_name','=',$request->department)->get();
            if($department->count()){
                return response()->json(404);//department name already exist
            }
            else{
                $data = new Department;
                $data->department_name = $request->department;
                $data->save();
                return response()->json ($data);   
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'department'=>'required',
            ]);

        if($validator->passes()){
            $department=Department::where('department_name','=',$request->department)->get();
            if($department->count()){
                return response()->json(401);//department name already exist,cannot be updated
            }
            $dept_data=Department::find($request->id);
            $dept_data->department_name=$request->department;
            $dept_data->save();
            return response()->json($dept_data);
        }else{
            return response()->json(404);//department name is required
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $faculty=Faculty::where('dept_id','=',$request->id)->get();
        if($faculty->count()){
            return response()->json(401);//department exists in faculty table
        }
        else{
            Department::find($request->id)->delete();
            return response()->json(200);    
        }
        
    }
}
