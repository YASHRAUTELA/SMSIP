<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;
use Validator;
use App\Faculty;
use App\Student;
use App\City;
class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $state_data=State::all();
        
        return view('crud.state')->with('state_data',$state_data);
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
                'state' => 'required'
            ]);
        if($validator->passes()){
            $state=State::where('state','=',$request->state)->get();
            if($state->count()){
                return response()->json(404);//state name already exist
            }
            $state_data=new State;
            $state_data->state=$request->state;
            $state_data->save();
            return response()->json($state_data);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'id'=>'required',
            'state'=>'required',
            ]);

        if($validator->passes()){
            $state=State::where('state','=',$request->state)->get();
            if($state->count()){
                return response()->json(401);//state name already exist
            }
            $state_data=State::find($request->id);
            $state_data->state=$request->state;
            $state_data->save();    
            return response()->json($state_data);
        }
        else{
            return response()->json(404);//state name is required
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $faculty=Faculty::where('state_id','=',$request->id)->get();
        $student=Student::where('state_id','=',$request->id)->get();
        $city=City::where('state_id','=',$request->id)->get();
        if($faculty->count()){
            return response()->json(401);//state name already exist in faculty table
        }
        if($student->count()){
            return response()->json(402);//state name already exist in student table
        }
        if($city->count()){
            return response()->json(403);//state name already exist in city table
        }
        State::find($request->id)->delete();
        return response()->json(200);
    }
}
