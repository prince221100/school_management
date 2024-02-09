<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Leave_Info;
use Illuminate\Http\Request;

class LeaveInfoController extends Controller
{
    public function leave_request(){

        if(session()->has('email')){
            $role = session()->get('role');
            if($role == 1){
                $rname = "Principle";
                return view('add-leave',['rname'=>$rname]);
            }elseif($role == 2){
                $rname = "Teacher";
                return view('add-leave-teacher',['rname'=>$rname,]);
            }else{
                $rname = "Student";
                return view('add-leave',['rname'=>$rname]);
            }
        }
        else{
            return redirect('/');
        }
    }
    public function add_leave(Request $request){
        // dd($request->all());
        if(session()->has('email')){
            $request->validate([
                'leavename'=> 'required',
                'startdate'=> 'required',
                'enddate'=> 'required',

            ]);
            // dd($request->all());
            $email = session()->get('email');
            $id = Admin::where('email',$email)->first();
            $email_id = $id->id;


            $val= Leave_Info::where(['user_id'=>$email_id,'type'=>$request->leavename,'start_date'=>$request->startdate,'end_date'=>$request->enddate])->first();
            // dd($val);
            if($val !== null ){
                echo "Data is already Exists!!";
                return redirect('/showstatus')->withErrors(['msg'=>'Date is already Exists!!']);
            }
            else{
                echo"Data is insert";
                $data = new Leave_Info();
                $data->user_id = $email_id;
                $data->type = $request->leavename;
                $data->start_date = $request->startdate;
                $data->end_date = $request->enddate;

                $data->save();

                return redirect("/showstatus")->withSuccess('Data is inserted Successfully');
            }

        }
        else{
            return redirect('/');
        }
    }
    public function show_studentleave(){
        if(session()->has('email')){
            $email = session()->get('email');
            $role = session()->get('role');

            // $student = Admin::where('role',3)->get();
            // dd($student);
            $val=Leave_Info::paginate(10);
            // dd($val);
            if($role == 1){
                $rname = "Principle";
                return view('showstudentleave',['rname'=>$rname,'val'=>$val]);

            }elseif($role == 2){
                $rname = "Teacher";
                return view('showstudentleave',['rname'=>$rname,'val'=>$val]);


            }else{
                $rname = "Student";
                return view('showstudentleave',['rname'=>$rname,'val'=>$val]);

            }
        }
        else{
            return redirect('/');
        }
    }
    public function acceptrequest($id){
        // dd($id);
        $upd = Leave_info::find($id);
        $upd->status = 1;
        $upd->save();
        return redirect("/showstudentleave")->withSuccess('Accept request Successfully');

    }
    public function denyrequest($id){
        // dd($id);
        $upd = Leave_info::find($id);
        $upd->status = 2;
        $upd->save();
        return redirect("/showstudentleave")->withSuccess('Deny request Successfully');

    }
    public function show_status(){
        if(session()->has('email')){
            $email = session()->get('email');
            $role = session()->get('role');

            $id = Admin::where('email',$email)->first();
            // dd($id->id);
            $val=Leave_Info::where('user_id',$id->id)->paginate(10);
            // dd($val);
            if($role == 1){
                $rname = "Principle";
                return view('showstatus',['rname'=>$rname,'val'=>$val]);

            }elseif($role == 2){
                $rname = "Teacher";
                return view('showstatusteacher',['rname'=>$rname,'val'=>$val]);


            }else{
                $rname = "Student";
                return view('showstatus',['rname'=>$rname,'val'=>$val]);

            }
        }
        else{
            return redirect('/');
        }
    }
    public function add_leave_teacher(Request $request){
        if(session()->has('email')){
            $request->validate([
                'leavename'=> 'required',
                'startdate'=> 'required',
                'enddate'=> 'required',

            ]);
            // dd($request->all());
            $email = session()->get('email');
            $id = Admin::where('email',$email)->first();
            $email_id = $id->id;


            $val= Leave_Info::where(['user_id'=>$email_id,'type'=>$request->leavename,'start_date'=>$request->startdate,'end_date'=>$request->enddate])->first();
            // dd($val);
            if($val !== null ){
                echo "Data is already Exists!!";
                return redirect('/showstatus')->withErrors(['msg'=>'Date is already Exists!!']);
            }
            else{
                echo"Data is insert";
                $data = new Leave_Info();
                $data->user_id = $email_id;
                $data->type = $request->leavename;
                $data->start_date = $request->startdate;
                $data->end_date = $request->enddate;

                $data->save();

                return redirect("/showstatus")->withSuccess('Data is inserted Successfully');
            }

        }
        else{
            return redirect('/');
        }
    }
    public function show_teacher_leave(){
        if(session()->has('email')){
            $email = session()->get('email');
            $role = session()->get('role');

            // $student = Admin::where('role',3)->get();
            // dd($student);
            $val=Leave_Info::paginate(10);
            // dd($val);
            if($role == 1){
                $rname = "Principle";
                return view('showteacherleave',['rname'=>$rname,'val'=>$val]);

            }elseif($role == 2){
                $rname = "Teacher";
                return view('showteacherleave',['rname'=>$rname,'val'=>$val]);


            }else{
                $rname = "Student";
                return view('showteacherleave',['rname'=>$rname,'val'=>$val]);

            }
        }
        else{
            return redirect('/');
        }
    }
    public function acceptrequesteacher($id){
        // dd($id);
        $upd = Leave_info::find($id);
        $upd->status = 1;
        $upd->save();
        return redirect("/showstatusteacher")->withSuccess('Accept request Successfully');

    }
    public function denyrequestteacher($id){
        // dd($id);
        $upd = Leave_info::find($id);
        $upd->status = 2;
        $upd->save();
        return redirect("/showstatusteacher")->withSuccess('Deny request Successfully');

    }

}
