<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use App\Student;
use App\Faculty;
use App\Mail;
use App\VerifyUser;
class UserController extends Controller
{
	public function deleteUserInfo(Request $request){
		$user=User::find($request->id);
		// return response()->json($user);

		if($user->role_id==1){

			/*return response()->json('admin');
			$user->delete();
			return response()->json('admin data deleted successfully');*/
			
				// return response()->json('main admin cannot be deleted');
				// return redirect()->route('smsAdmin')->with("update_success","Main Admin cannot be deleted");
			
				// return response()->json('admin data deleted successfully');
				$verify_user=VerifyUser::where('user_id','=',$request->id)
							->get();


				$admin_mail=Mail::where('to_email','=',$user->email)
									->orWhere('from_email','=',$user->email)
									->get();
				

				if($verify_user->count()){

						$verify_user=VerifyUser::where('user_id','=',$request->id)
							->delete();
				}

				if($admin_mail->count()){
						$admin_mail=Mail::where('to_email','=',$user->email)
									->orWhere('from_email','=',$user->email)
									->delete();
				}
				$user->delete();
				return response()->json('admin and its all associated data deleted successfully');	
			
			
		}
		elseif($user->role_id==2){

			$faculty=Faculty::where('user_id','=',$request->id)->get();

			$verify_user=VerifyUser::where('user_id','=',$request->id)
						->get();

			$faculty_mail=Mail::where('to_email','=',$user->email)
								->orWhere('from_email','=',$user->email)
								->get();

			//true if faculty_data exists in faculty data
			if($faculty->count()){
				$faculty[0]->delete();
			}

			if($verify_user->count()){

					$verify_user=VerifyUser::where('user_id','=',$request->id)
						->delete();
			}

			if($faculty_mail->count()){
					$faculty_mail=Mail::where('to_email','=',$user->email)
								->orWhere('from_email','=',$user->email)
								->delete();
			}
			$user->delete();
			return response()->json('faculty and its all associated data deleted successfully');

		}
		else{
			
			$student=Student::where('user_id','=',$request->id)->get();
			
			$verify_user=VerifyUser::where('user_id','=',$request->id)
						->get();


			$student_mail=Mail::where('to_email','=',$user->email)
								->orWhere('from_email','=',$user->email)
								->get();
			
			if($student->count()){
				$student[0]->delete();
			}

			if($verify_user->count()){

					$verify_user=VerifyUser::where('user_id','=',$request->id)
						->delete();
			}

			if($student_mail->count()){
					$student_mail=Mail::where('to_email','=',$user->email)
								->orWhere('from_email','=',$user->email)
								->delete();
			}
			$user->delete();
			return response()->json('student and its all associated data deleted successfully');
		}
	}


	/*
	*Performing update operation on user data
	*/
	public function updateAdmin(Request $request){
		$admin_data=$request->validate([
			'id'=>'required',
			'name'=>'required|min:3',
			'email'=>'required|email',
			'dob'=>'required|date'
			]);

		$admin=User::find($request->id);
		$admin->name=$request->name;
		$admin->email=$request->email;
		$admin->dob=$request->dob;
		if($admin->save()){
			return redirect()->route('smsAdmin')->with("update_success","Record updated successfully");
		}
		else{
			return redirect()->back()->with("update_failure","Record not updated, Please try again");
		}
	}

	/*
	*Showing the edit page for selected admin
	*/
	public function editAdmin($id){
		$admin_data=User::find($id);
		return view('crud.admin.updateAdmin')->with('data',$admin_data);
	}

	/*
	*Rendering particular user Info on modal
	*/
	public function getUserInfo(Request $request){
		$user_data=User::find($request->id);
		return response()->json($user_data);
	}

	/*
	*Getting those users details who are students
	*/
    public function getUser(){

    	$user=DB::table('users')
		    ->whereNotIn('id', function($query)
		    {
		        $query->select(DB::raw('user_id'))
		              ->from('students')
		              ->whereRaw('students.user_id = users.id');
		    })
		    ->get();

    	return response()->json($user);
    }

    /*
    *Getting and Rendering admin details
    */
    public function getAdmin(){
    	
    	 $admin_data= User::where('role_id','=',1)->get();
    	 
        if($admin_data->count()){
            return view('crud.admin.admins')->with('data',$admin_data);    
        }
        else{
            return view('crud.admin.noAdmin');
        }
    }
}
