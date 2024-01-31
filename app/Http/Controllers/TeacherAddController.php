<?php

namespace App\Http\Controllers;

use App\Mail\TeacherMail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TeacherAddController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(session()->has('email')){
            $email = session()->get('email');
            $role = session()->get('role');
            // dd($role);
            $teacher = Admin::where('role',2)->paginate(5);

            // dd($teacher);
            if($role == 1){
                $rname = "Principle";
                $data = Admin::where('email',$email)->first();

                return view('teachers',['rname'=>$rname,'data'=>$data,'teacher'=>$teacher]);
            }elseif($role == 2){
                $rname = "Teacher";
                $data = Admin::where('email',$email)->first();
                return view('teachers',['rname'=>$rname,'data'=>$data,'teacher'=>$teacher]);

            }else{
                $rname = "Student";
                $data = Admin::where('email',$email)->first();
                // dd($data);
                return view('teachers',['rname'=>$rname,'data'=>$data,'teacher'=>$teacher]);
            }
        }
        else{
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        if(session()->has('email')){
            $email = session()->get('email');
            $role = session()->get('role');
            // dd($role);
            if($role == 1){
                $rname = "Principle";
                $data = Admin::where('email',$email)->first();

                return view('add-teacher',['rname'=>$rname,'data'=>$data]);
            }elseif($role == 2){
                $rname = "Teacher";
                $data = Admin::where('email',$email)->first();
                return view('add-teacher',['rname'=>$rname,'data'=>$data]);

            }else{
                $rname = "Student";
                $data = Admin::where('email',$email)->first();
                // dd($data);
                return view('add-teacher',['rname'=>$rname,'data'=>$data]);
            }
        }
        else{
            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $fname = $request->firstname;
        $lname = $request->lastname;
        $mno = $request->mobile;
        $email = $request->email;
        $pwd= $request->password;


        // dd($fname,$lname,$mno,$email,$pwd);


        $val = Admin::where('email',$email)->first();
        // dd($val);
        if($val !== null){
            return redirect('/addteacher/create')->withErrors(['msg' => 'Email Id is already exists!']);
        }
        else{
                // echo "Data is inserted";
                $data = new Admin();
                $data->firstname = $fname;
                $data->lastname = $lname;
                $data->role = 2;
                $data->mobileno = $mno;
                $data->email = $email;
                $data->password = $pwd;
                $data->save();

                Mail::to($email)->send(new TeacherMail ($request));
                return redirect('/addteacher')->withSuccess('Teacher Data is inserted successfully!');
            }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        // echo "show";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(session()->has('email')){
            $email = session()->get('email');
            $role = session()->get('role');
            // dd($role);
            $val=Admin::find($id);
            if($role == 1){
                $rname = "Principle";
                $data = Admin::where('email',$email)->first();

                return view('edit-teacher',['rname'=>$rname,'data'=>$data,'val'=>$val]);
            }elseif($role == 2){
                $rname = "Teacher";
                $data = Admin::where('email',$email)->first();
                return view('edit-teacher',['rname'=>$rname,'data'=>$data,'val'=>$val]);

            }else{
                $rname = "Student";
                $data = Admin::where('email',$email)->first();
                // dd($data);
                return view('edit-teacher',['rname'=>$rname,'data'=>$data,'val'=>$val]);
            }
        }
        else{
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $data = Admin::find($id);
        $data->firstname=$request->firstname;
        $data->lastname=$request->lastname;
        $data->mobileno=$request->mobile;
        $data->password=$request->password;

        $data->save();
        return redirect('addteacher');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        $teacher = Admin::find($id);
        // dd($teacher);
        $teacher->delete();
        return redirect('addteacher')->withsuccess('Data is Deleted');
    }
}
