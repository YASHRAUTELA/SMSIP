<?php

namespace App\Http\Controllers;

use App\Faculty;
use Illuminate\Http\Request;
use App\User;
use DB;
class FacultyController extends Controller
{
        /*
    *Rendering Faculty
    */
    public function getFaculty(){
        $faculty_data=User::where('role_id','=',2)->get();

        if($faculty_data->count()){
            return view('crud.admin.faculties')->with('data',$faculty_data);    
        }
        else{
            return view('crud.admin.noFaculty');
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show(Faculty $faculty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faculty_data=DB::table('faculties as f')
                        ->join('users as u','u.id','=','f.user_id')
                        ->join('departments as d','d.id','=','f.dept_id')
                        ->join('states as st','st.id','=','f.state_id')
                        ->join('cities as ct','ct.id','=','f.city_id')
                        ->where('f.user_id','=',$id)
                        ->select('u.id','u.name','u.email','u.image_title','u.dob','ct.city','st.state','d.department_name','f.address','f.city_id','f.dept_id','f.state_id','f.contact','f.doj','f.pin','f.father_name','f.mother_name')
                        ->get();

        
        /*echo "<pre>";
        print_r($faculty_data->id);
        echo "<br>";
        print_r($faculty_data->count());
        exit;*/
        if($faculty_data->count()){
            /*echo "hello";
            exit;*/
            return view('crud.admin.updateFaculty')->with('data',$faculty_data[0]);

        }
        else{
            /*$pages_array[] = (object) array('slug' => 'xxx', 'title' => 'etc')*/


            $user_data=User::find($id);
            /*echo "<pre>";
            print_r($user_data->id);
            echo "<br>";
            print_r($user_data);
            exit;*/
            if($user_data->exists()){
                $user_data_temp[]=(object) array('id'=>$user_data->id,'name'=>$user_data->name,'email'=>$user_data->email,'image_title'=>$user_data->image_title,'dob'=>$user_data->dob,'city'=>'','state'=>'','doj'=>'','address'=>'','city_id'=>'','state_id'=>'','contact'=>'','dept_id'=>'','pin'=>'','father_name'=>'','mother_name'=>'');
                /*echo "<pre>";
                print_r($user_data_temp[0]);
                echo "<br>";
                print_r($user_data_temp[0]->name);
                echo "<br>";
                exit;*/
                return view('crud.admin.updateFaculty')->with('data',$user_data_temp[0]);
            }else{
                return redirect()->back();
            }   
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $faculty_data=$request->validate([
            'id'=>'required',
            'name'=>'required|max:50',
            'email'=>'required|email',
            'dob'=>'required|date',
            'father_name'=>'required|min:3',
            'mother_name'=>'required|min:3',
            'state'=>'required',
            'city'=>'required',
            'contact'=>'required|max:10',
            'department'=>'required',
            'doj'=>'required|date',
            'pin'=>'required',
            'address'=>'required'
            ]);
        


        $user_data=User::find($request->id);
        /*echo "<pre>";
        print_r($user_data);
        exit;*/
        // $user_data->id=$request->id;
        $user_data->name=$request->name;
        $user_data->email=$request->email;
        $user_data->dob=$request->dob;

        if($user_data->save()){
            $faculty_data=Faculty::where('user_id','=',$request->id)->get();
            if($faculty_data->count()){

                /*It will update faculty data if his/her data already exists*/

                $faculty_data=Faculty::where('user_id','=',$request->id)
                                    ->update([
                                        'father_name'=>$request->father_name,
                                        'mother_name'=>$request->mother_name,
                                        'state_id'=>$request->state,
                                        'city_id'=>$request->city,
                                        'contact'=>$request->contact,
                                        'dept_id'=>$request->department,
                                        'doj'=>$request->doj,
                                        'pin'=>$request->pin,
                                        'address'=>$request->address
                                        ]);
                return redirect()->route('smsFaculty')->with("update_success","Record updated successfully");
            }
            else{
                /*It will create a new faculty and executes in the case when user exists but his/her other details does not exist*/

                $faculty_data=new Faculty;
                $faculty_data->user_id=$request->id;
                $faculty_data->address=$request->address;
                $faculty_data->city_id=$request->city;
                $faculty_data->state_id=$request->state;
                $faculty_data->contact=$request->contact;
                $faculty_data->dept_id=$request->department;
                $faculty_data->doj=$request->doj;
                $faculty_data->pin=$request->pin;
                $faculty_data->father_name=$request->father_name;
                $faculty_data->mother_name=$request->mother_name;
                
                if($faculty_data->save()){
                    return redirect()->route('smsFaculty')->with("update_success","Record updated successfully");
                }
                else{
                    return redirect()->back()->with("update_failure","Record not updated, Please try again");
                }
            }
        }
        else{
            return redirect()->back()->with("update_failure","Record not updated, Please try again");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faculty $faculty)
    {
        //
    }
}
