<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use DB;
use App\State;
use Validator;
use App\Student;
use App\Faculty;
class CityController extends Controller
{

    public function getStateData(){
        $state=State::all();
        return response()->json($state);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $city_data=DB::table('cities')
            ->join('states','states.id','=','cities.state_id')
            ->select('cities.*','states.state')
            ->get();
        return view('crud.city')->with('city_data',$city_data);
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
            'city'=>'required',
            'state1'=>'required'
            ]);

        if($validator->passes()){
            $city=City::where('city','=',$request->city)
                        ->where('state_id','=',$request->state1)
                        ->get();    
            if($city->count()){
                return response()->json(404);//if data already exist
            }else{
                $city_data=new City;
                $city_data->city=$request->city;
                $city_data->state_id=$request->state1;
                $city_data->save();
                $updated_city=DB::table('cities')
                    ->join('states','states.id','=','cities.state_id')
                    ->select('cities.*','states.state')
                    ->orderBy('cities.id', 'desc')
                    ->first();
                return response()->json($updated_city);
                // return response()->json($city_data)
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $validator=Validator::make($request->all(),[
            'city'=>'required',
            'state'=>'required',
            ]);
        if($validator->passes()){
            $city=City::where('city','=',$request->city)
                        ->where('state_id','=',$request->state)
                        ->get();
            if($city->count()){
                return response()->json(401);//city with same state already exist,cannot be updated
            }
            $city_data=City::find($request->id);
            $city_data->city=$request->city;
            $city_data->state_id=$request->state;
            $city_data->save();

            $updated_city=DB::table('cities')
                            ->join('states','states.id','=','cities.state_id')
                            ->select('cities.*','states.state')
                            ->where('cities.id','=',$request->id)
                            ->get();

            return response()->json($updated_city);    
        }
        else{
            return response()->json(404);//both city and state are required
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $faculty=Faculty::where('city_id','=',$request->id)->get();
        $student=Student::where('city_id','=',$request->id)->get();
        if($faculty->count()){
            return response()->json(404);
        }
        elseif($student->count()){
            return response()->json(401);
        }
        else{
            $city=City::find($request->id)->delete();
            return response()->json(200);            
        }
    }
}
    