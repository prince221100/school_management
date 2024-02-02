<?php

namespace App\Http\Controllers;

use App\Mail\forgotmail;
use App\Models\Admin;
use App\Models\Class_data;
use App\Models\Class_info;
use App\Models\Notice_Board_info;
use App\Models\Students_info;
use App\Models\Subject_info;
use Carbon\Carbon;
use Illuminate\Auth\Passwords\PasswordResetServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function register_data(Request $req){
        // dd($req->all());
        $req->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'role' => 'required',
            'mno' => 'required',
            'email' => 'required',
            'pwd' => 'required',
            'pwd1' => 'required',


        ]);
        $fname = $req->firstname;
        $lname = $req->lastname;
        $role = $req->role;
        $mno = $req->mno;
        $email = $req->email;
        $pwd= $req->pwd;
        $pwd1 = $req->pwd1;

        // dd($fname,$lname,$role,$mno,$email,$pwd,$pwd1);
        if($pwd === $pwd1){
            // echo "Data is inserted";
            $val = Admin::where('email',$email)->first();
            // dd($val);
            if($val !== null){
                // echo "Email id is exists";
                return redirect('/register')->withErrors(['msg' => 'Email Id is already exists!']);

            }
            else{
                // echo "Data is inserted";
                $data = new Admin();
                $data->firstname = $fname;
                $data->lastname = $lname;
                $data->role = $role;
                $data->mobileno = $mno;
                $data->email = $email;
                $data->password = $pwd;
                $data->save();

                // $req->session()->put('fname',$fname);
                session(['fname'=>$fname,'role'=>$role,'email'=>$email]);
                return redirect('/dashboard');
            }


        }
        else{
            return redirect('/register')->withErrors(['msg' => 'Password is not match']);
        }

    }
    public function login(Request $val){
        // dd($val);
        $val->validate([
            'role' => 'required',
            'email' => 'required',
            'pwd2' => 'required',
        ]);
        $email = $val->email;
        $role = $val->role;
        $pwd = $val->pwd2;
        // dd($email,$role,$pwd);


        $data = Admin::where([ ['email',$email],['role',$role]])
        ->first();
        // dd($data);
        if($data !== null){
            $fname1 = $data->firstname;
            $pwd1 = $data->password;
            // dd($fname1,$pwd1,$pwd);
            if($pwd == $pwd1)
            {
                session(['fname'=> $fname1,'role'=>$role,'email'=>$email]);
                return redirect('/dashboard');
            }
            else{
                return redirect('/')->withErrors(['msg' => 'Password is incorrect']);
            }

        }
        else{
            return redirect('/')->withErrors(['msg' => 'Email is Not Found']);


        }


    }
    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/');
    }
    public function dashboard(Request $request){
        if($request->session()->has('email')){
                // return view('dashboard');
            $email = session()->get('email');

            $role = session()->get('role');
            // dd($role);

            $scount = Admin::where('role','3')->count();
            $tcount = Admin::where('role','2')->count();

            $totalsubject = Subject_info::count();

            // dd(date('Y-m-d'));
            $notice = Notice_Board_info::where('date',date('Y-m-d'))->first();
            // dd($notice);

            if($role == 1){
                $rname = "Principle";
                $totalclass= Class_info::count();
                // dd($totalclass);
                // dd($totalsubject);
                return view('dashboard',['rname'=>$rname,'scount'=>$scount,'tcount'=>$tcount,'totalclass'=>$totalclass,'totalsubject'=>$totalsubject]);
            }elseif($role == 2){
                $rname = "Teacher";
                $id = Admin::where('email',$email)->first();
                // dd($id->id);
                $totaldata = Class_data::where('teacher_id',$id->id)->count();
                // dd($totaldata);

                return view('teacher-dashboard',['rname'=>$rname,'scount'=>$scount,'tcount'=>$tcount,'totaldata'=>$totaldata,'totalsubject'=>$totalsubject ,'notice'=>$notice]);
            }else{
                $rname = "Student";
                $id=Admin::where('email',$email)->first();
                // dd($id->id);
                $classname = Students_info::where('student_id',$id->id)->first();
                // dd($classname);
                if($classname != null){
                    $totalstu = Students_info::where('class_name',$classname->class_name)->count();
                    // dd($totalstu);
                    return view('student-dashboard',['rname'=>$rname,'scount'=>$scount,'tcount'=>$tcount,'classname'=>$classname->class_name,'totalstudent'=>$totalstu,'notice'=>$notice]);
                }
                else{
                    $classname1 = 0;
                    $totalstu1=0;
                    return view('student-dashboard',['rname'=>$rname,'scount'=>$scount,'tcount'=>$tcount,'classname'=>$classname1,'totalstudent'=>$totalstu1,'notice'=>$notice]);

                }
            }
        }
        else{
            return redirect('/');
        }

    }
    public function forgot_password(){
        return view('forgot-password');
    }
    public function forgot(Request $request){
        // dd($request->all());
        $email = $request->email;
        // dd($email);
        $data = Admin::where('email',$email)->first();
        // dd($data);
        if($data == null){
            return redirect('/forgot_password')->withErrors(['msg' => 'Email is Not Found']);
        }
        else{
            // echo "Email is Found";
            // dd($request->all());



            $store = DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $request->_token,
                'created_at' => Carbon::now()
            ]);

            Mail::to($email)->send(new forgotmail($request));
            return redirect("/forgot_password")->withSuccess('Reset Password Link is send in Email');

        }

    }
    public function reset_password($email,$token){
        $email = $email;
        $token = $token;
        // dd($token,$email);
        return view('Reset_mail',['token'=>$token,'email'=>$email]);
    }

    public function reset(Request $request){
        // dd($request->all());
        $request->validate([
            'pwd' => 'required',
            'pwd1' => 'required',
        ]);

        $val = DB::table('password_reset_tokens')->where('token',$request->_token)->first();
        // dd($val);
        if($val == null){
            return redirect("/")->withErrors(['msg'=> 'You are not memeber our webpage']);

        }else{
            // echo "Data updated";
            $pass= $request->pwd;
            $pass1= $request->pwd1;
            $email = $val->email;
            if($pass == $pass1){
                // echo "Password is match";
                $upd = Admin::where('email',$email)->update(['password'=> $pass]);

                DB::table('password_reset_tokens')->where('email',$email)->delete();

                return redirect('/')->withSuccess('Password is Updated Successfully..');

            }
            else{
                DB::table('password_reset_tokens')->where('email',$email)->delete();

                return redirect("/forgot_password")->withErrors(['msg'=> 'Try Again! Password is not match']);
            }
        }

    }
    public function profile(Request $request){
    if($request->session()->has('email')){

        // return view('profile');
        $email = session()->get('email');
        $role = session()->get('role');
        // dd($role);
        if($role == 1){
            $rname = "Principle";
            $data = Admin::where('email',$email)->first();

            return view('profile',['rname'=>$rname,'data'=>$data]);
        }elseif($role == 2){
            $rname = "Teacher";
            $data = Admin::where('email',$email)->first();
            return view('profile',['rname'=>$rname,'data'=>$data]);
        }else{
            $rname = "Student";
            $data = Admin::where('email',$email)->first();
            // dd($data);
            return view('profile',['rname'=>$rname,'data'=>$data]);
        }
    }
    else{
        return redirect('/');
    }
    }
    public function update_profile(Request $request){
        // dd($request->all());
        $email = session()->get('email');
        // dd($email);
        $fname = $request->fname;
        $lname = $request->lname;
        $mno = $request->mno;
        $pass = $request->pass;


        $upd = Admin::where('email',$email)->first();
        // dd($upd);
        $upd->firstname=$fname;
        $upd->lastname=$lname;
        $upd->mobileno=$mno;
        $upd->password=$pass;
        $upd->save();
        return redirect('/profile');

    }


}
