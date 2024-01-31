<?php

namespace App\Http\Controllers;

use App\Mail\StudentMail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StudentAddController extends Controller
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
            $student = Admin::where('role',3)->paginate(5);

            // dd($teacher);
            if($role == 1){
                $rname = "Principle";
                $data = Admin::where('email',$email)->first();

                return view('students',['rname'=>$rname,'data'=>$data,'teacher'=>$student]);
            }elseif($role == 2){
                $rname = "Teacher";
                $data = Admin::where('email',$email)->first();
                return view('students',['rname'=>$rname,'data'=>$data,'teacher'=>$student]);

            }else{
                $rname = "Student";
                $data = Admin::where('email',$email)->first();
                // dd($data);
                return view('students',['rname'=>$rname,'data'=>$data,'teacher'=>$student]);
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

                return view('add-student',['rname'=>$rname,'data'=>$data]);
            }elseif($role == 2){
                $rname = "Teacher";
                $data = Admin::where('email',$email)->first();
                return view('add-student',['rname'=>$rname,'data'=>$data]);

            }else{
                $rname = "Student";
                $data = Admin::where('email',$email)->first();
                // dd($data);
                return view('add-student',['rname'=>$rname,'data'=>$data]);
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
            return redirect('/addstudent/create')->withErrors(['msg' => 'Email Id is already exists!']);
        }
        else{
                // echo "Data is inserted";
                $data = new Admin();
                $data->firstname = $fname;
                $data->lastname = $lname;
                $data->role = 3;
                $data->mobileno = $mno;
                $data->email = $email;
                $data->password = $pwd;
                $data->save();

                Mail::to($email)->send(new StudentMail($request));
                return redirect('/addstudent')->withSuccess('Student Data is inserted successfully!');
            }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

                return view('edit-student',['rname'=>$rname,'data'=>$data,'val'=>$val]);
            }elseif($role == 2){
                $rname = "Teacher";
                $data = Admin::where('email',$email)->first();
                return view('edit-student',['rname'=>$rname,'data'=>$data,'val'=>$val]);

            }else{
                $rname = "Student";
                $data = Admin::where('email',$email)->first();
                // dd($data);
                return view('edit-student',['rname'=>$rname,'data'=>$data,'val'=>$val]);
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
        //
        // dd($request->all());
        $data = Admin::find($id);
        $data->firstname=$request->firstname;
        $data->lastname=$request->lastname;
        $data->mobileno=$request->mobile;
        $data->password=$request->password;

        $data->save();
        return redirect('addstudent');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //  dd($id);
         $student = Admin::find($id);
        //  dd($student);
         $student->delete();
         return redirect('addstudent')->withsuccess('Data is Deleted');
    }
}
