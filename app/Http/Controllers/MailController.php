<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Mail;
use DB;
class MailController extends Controller
{

        /*
    Deleting the selected mail
    */
    public function deleteData(Request $request){
        $id=$request->id;
        
        $mail=Mail::find($id);

        $mail->delete();
      
        $user_email=Session::get('user_email');

        $left_mail=Mail::where('to_email','=',$user_email)->get();
         
        return response()->json($left_mail);
    }


    /*
    rendering the individual sent Mail to the Bootstrap Modal with detailed description
    */
    public function sentData(Request $request){
      
        $sent_mail_data=DB::select('select u.email,u.image_title,u.name,m.* from users u INNER JOIN mails m where u.email=m.to_email and m.id="'.$request->id.'"');               

        return response()->json($sent_mail_data);    
    }


    /*
    rendering all the sent Mails to Sent MailBox
    */
    public function sentMails(){
        $user_email=Session::get('user_email');
       
        $mail=Mail::where('from_email','=',$user_email)->get();

        if($mail->count()){
            $sent_mail_data=DB::table('users')
                            ->join('mails','users.email','=','mails.to_email')
                            ->select('users.name','users.image_title','mails.*')
                            ->where('mails.user_id','=',Session::get('user_id'))
                            ->get();

            return view('mails.sentMail')->with('mail',$sent_mail_data);
        }
        else{
            /*echo "failure";*/
            return view('mails.emptySentBox');
        }
    }


    /*
    Rendering the individual mails in INBOX with detailed description
    */
    public function getData(Request $request){
        $select_mail_data=DB::table('mails')
                            ->join('users','users.id','=','mails.user_id')
                            ->select('users.image_title','users.name','mails.*')
                            ->where('mails.id','=',$request->id)
                            ->get();
        return response()->json($select_mail_data);

    }

    /*
    Rendering the Compose Mail Box
    */
    public function composeMail(){
        
        return view('mails.compose');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_email=Session::get('user_email');
       
        $mail=Mail::where('to_email','=',$user_email)->get();
        
        if($mail->count()){
            $inbox_mail_data=DB::table('users')
                        ->join('mails','users.email','=','mails.from_email')
                        ->select('users.name','users.image_title','mails.*')
                        ->where('mails.to_email','=',$user_email)
                        ->get();

            return view('mails.inbox')->with('mail',$inbox_mail_data);
        }
        else{
            return view('mails.emptyInbox');
        }
    }
    /*
     *
     * Validating and creating a mail posted through Compose MailBox.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = $request->validate([
                'to_email'=>'required|email|exists:users,email',
             'from_email'=>'required|email|exists:users,email',
            'subject'=>'required|max:50',
            'message'=>'required|max:255',
            'attachment' =>'max:2048|mimes:jpeg,png,jpg',
            'user_id'=>'required',

            ]);

            if($request->attachment==''){
                
                $fileName='no_image.jpg';
                
            }
            else{
                $fileName = time().'.'.$request->attachment->getClientOriginalExtension();
                $request->attachment->move(public_path('file-uploads'), $fileName);    
            }

            $mail=new Mail;
            $mail->to_email=$request->to_email;
            $mail->from_email=$request->from_email;
            $mail->subject=$request->subject;
            $mail->message=$request->message;
            $mail->attachment=$fileName;
            $mail->user_id=$request->user_id;
            $mail->save();

            

            if($mail){
                Session::put('success','Mail Sent Successfully');
            }
            else{
                Session::put('failure','Mail not sent');
            }
            return redirect()->back();
               
    }


}
