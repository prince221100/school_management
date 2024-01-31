<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Class_data;
use App\Models\Class_info;
use App\Models\Students_info;
use App\Models\Subject_info;
use Illuminate\Http\Request;

class StudentsInfoController extends Controller
{
    public function assignclass_student(){

        if(session()->has('email')){
            $email = session()->get('email');
            $role = session()->get('role');
            // dd($role);
            $class = Class_info::all();
            $student = Admin::where('role','=','3')->get();

            // dd($class);
            if($role == 1){
                $rname = "Principle";
                return view('assignclass-student',['rname'=>$rname,'class'=>$class,'student'=>$student]);
            }elseif($role == 2){

                $rname = "Teacher";
                return view('assignclass-student',['rname'=>$rname,'class'=>$class,'student'=>$student]);
            }else{
                $rname = "Student";
                return view('assignclass-student',['rname'=>$rname,'class'=>$class,'student'=>$student]);
            }
        }
        else{
            return redirect('/');
        }
    }
    public function addclassstudent(Request $request){
        // dd($request->all());
        $request->validate([
            'classname' => 'required',
            'studentname' => 'required',

        ]);

        $chk = Students_info::where('student_id',$request->studentname)->first();
        // dd($chk);

        if($chk !== null ){
            // echo "Data is already Exists!!";
            return redirect('/showdata-student')->withErrors(['msg'=>'Student is already assign class!!']);
        }
        else{
            // echo"Data is insert";
            $data = new Students_info();
            $data->class_name = $request->classname;
            $data->student_id = $request->studentname;
            $data->save();

            return redirect("/showdata-student")->withSuccess('Class is Assigned Successfully');
        }
    }
    public function showdatastudent(){
        if(session()->has('email')){
            $email = session()->get('email');
            $role = session()->get('role');

            $val= Students_info::paginate(10);

            if($role == 1){
                $rname = "Principle";
                return view('showdatastudent',['rname'=>$rname,'val'=>$val]);

            }elseif($role == 2){
                $rname = "Teacher";
                return view('showdatastudent',['rname'=>$rname,'val'=>$val]);


            }else{
                $rname = "Student";
                return view('showdatastudent',['rname'=>$rname,'val'=>$val]);

            }
        }
        else{
            return redirect('/');
        }
    }
    public function editdatastudent($id){
        // dd($id);
        if(session()->has('email')){
            $role = session()->get('role');

            $val= Students_info::find($id);
            // dd($val);
            $class = Class_info::all();
            $student = Admin::where('role','=','3')->get();

            if($role == 1){
                $rname = "Principle";
                return view('edit-studentclass',['rname'=>$rname,'val'=>$val,'class'=>$class,'student'=>$student]);

            }elseif($role == 2){
                $rname = "Teacher";
                return view('edit-studentclass',['rname'=>$rname,'val'=>$val,'class'=>$class,'student'=>$student]);

            }else{
                $rname = "Student";
                return view('edit-studentclass',['rname'=>$rname,'val'=>$val,'class'=>$class,'student'=>$student]);

            }
        }
        else{
            return redirect('/');
        }
    }
    public function updatedatastudent(Request $request,$id){
        // dd($request->all());

        $val= Students_info::where(['class_name'=>$request->classname,'student_id'=>$request->studentname])->first();
        // dd($val);
        if($val !== null ){
            echo "Data is already Exists!!";
            return redirect('/showdata-student')->withErrors(['msg'=>'Data is already Exists!!']);
        }
        else{
            echo"Data is insert";
            $data = Students_info::find($id);
            // dd($data);
            $data->class_name = $request->classname;
            // $data->student_id = $request->studentname;
            $data->save();

            return redirect("/showdata-student")->withSuccess('Data is Updated Successfully');
        }

    }
    public function deldatastudent($id){
        // dd($id);
        $data = Students_info::find($id);
        $data->delete();
        return redirect("/showdata-student")->withSuccess('Data is Deleted Successfully');
    }

    public function classmatedetail(){

        if(session()->has('email')){
            $email = session()->get('email');
            $role = session()->get('role');

            $val= Students_info::paginate(10);

            if($role == 1){
                $rname = "Principle";
                return view('classmate',['rname'=>$rname,'val'=>$val]);

            }elseif($role == 2){
                $rname = "Teacher";
                return view('classmate',['rname'=>$rname,'val'=>$val]);


            }else{
                $rname = "Student";
                $id=Admin::where('email',$email)->first();
                // dd($id->id);
                $classname = Students_info::where('student_id',$id->id)->first();
                // dd($classname->class_name);
                if($classname != null){
                    $data = Students_info::where('class_name',$classname->class_name)->paginate(10);
                    // dd($data);
                    return view('classmate',['rname'=>$rname,'data'=>$data]);
                }
                else{
                    $data1 = 0;
                    return view('classmate',['rname'=>$rname,'data'=>$data1]);

                }

            }
        }
        else{
            return redirect('/');
        }
    }
    public function subjectdetails(){

        if(session()->has('email')){
            $email = session()->get('email');
            $role = session()->get('role');

            $val= Students_info::paginate(10);

            if($role == 1){
                $rname = "Principle";
                return view('subjectdetails',['rname'=>$rname,'val'=>$val]);

            }elseif($role == 2){
                $rname = "Teacher";
                return view('subjectdetails',['rname'=>$rname,'val'=>$val]);
            }else{
                $rname = "Student";
                $id = Admin::where('email',$email)->first();
                $class = Students_info::where('student_id',$id->id)->first();
                // dd($class->class_name);
                if($class != null){
                    $data = Class_data::where('class_name',$class->class_name)->paginate(5);

                    return view('subjectdetails',['rname'=>$rname,'val'=>$data]);
                }else{
                    $val1=0;
                    return view('subjectdetails',['rname'=>$rname,'val'=>$val1]);

                }

            }
        }
        else{
            return redirect('/');
        }
    }
}
