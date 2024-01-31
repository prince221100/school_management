<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Class_data;
use App\Models\Class_info;
use App\Models\Subject_info;
use Illuminate\Http\Request;

class ClassDataController extends Controller
{
    public function assignclass_teacher(){

        if(session()->has('email')){
            $email = session()->get('email');
            $role = session()->get('role');
            // dd($role);
            $class = Class_info::all();
            $subject = Subject_info::all();
            $teacher = Admin::where('role','=','2')->get();
            // dd($class);
            if($role == 1){
                $rname = "Principle";
                return view('assignclass-teacher',['rname'=>$rname,'class'=>$class,'subject'=>$subject,'teacher'=>$teacher]);
            }elseif($role == 2){
                $rname = "Teacher";
                return view('assignclass-teacher',['rname'=>$rname,'class'=>$class,'subject'=>$subject,'teacher'=>$teacher]);
            }else{
                $rname = "Student";
                return view('assignclass-teacher',['rname'=>$rname,'class'=>$class,'subject'=>$subject,'teacher'=>$teacher]);
            }
        }
        else{
            return redirect('/');
        }
    }
    public function addclassteacher(Request $request){
        // dd($request->all());
        $request->validate([
            'classname' => 'required',
            'subjectname' => 'required',
            'teachername' => 'required',

        ]);

        $val= Class_data::where(['class_name'=>$request->classname,'subject_name'=>$request->subjectname,'teacher_id'=>$request->teachername])->first();
        // dd($val);
        if($val!== null ){
            // echo "Data is already Exists!!";
            return redirect('/showdata')->withErrors(['msg'=>'Data is already Exists!!']);
        }
        else{
            // echo"Data is insert";
            $data = new Class_data();
            $data->class_name = $request->classname;
            $data->subject_name = $request->subjectname;
            $data->teacher_id = $request->teachername;
            $data->save();

            return redirect("/showdata")->withSuccess('Class is Assigned Successfully');
        }

    }
    public function showdata(){
        if(session()->has('email')){
            $email = session()->get('email');
            $role = session()->get('role');

            $val= Class_data::paginate(10);

            if($role == 1){
                $rname = "Principle";
                return view('showdata',['rname'=>$rname,'val'=>$val]);

            }elseif($role == 2){
                $rname = "Teacher";
                $data = Admin::where('email',$email)->first();
                // dd($data->id);
                $num = Class_data::where('teacher_id',$data->id)->paginate(10);
                // dd($num);
                if($num !== null){
                    return view('showdata',['rname'=>$rname,'val'=>$num]);
                }else{
                    echo "Data is not found";
                    return view('Data_not_found',['rname'=>$rname]);
                }

            }else{
                $rname = "Student";
                return view('showdata',['rname'=>$rname,'val'=>$val]);

            }
        }
        else{
            return redirect('/');
        }
    }
    public function editdata($id){
        // dd($id);
        if(session()->has('email')){
            $email = session()->get('email');
            $role = session()->get('role');

            $val= Class_data::find($id);
            // dd($val);
            $class = Class_info::all();
            $subject = Subject_info::all();
            $teacher = Admin::where('role','=','2')->get();

            if($role == 1){
                $rname = "Principle";
                return view('edit-teacherclass',['rname'=>$rname,'val'=>$val,'class'=>$class,'subject'=>$subject,'teacher'=>$teacher]);

            }elseif($role == 2){
                $rname = "Teacher";
                return view('edit-teacherclass',['rname'=>$rname,'val'=>$val,'class'=>$class,'subject'=>$subject,'teacher'=>$teacher]);

            }else{
                $rname = "Student";
                return view('edit-teacherclass',['rname'=>$rname,'val'=>$val,'class'=>$class,'subject'=>$subject,'teacher'=>$teacher]);

            }
        }
        else{
            return redirect('/');
        }
    }
    public function updatedata(Request $request,string $id){
        // dd($request->all());

        $val= Class_data::where(['class_name'=>$request->classname,'subject_name'=>$request->subjectname,'teacher_id'=>$request->teachername])->first();
        // dd($val);
        if($val !== null ){
            echo "Data is already Exists!!";
            return redirect('/showdata')->withErrors(['msg'=>'Data is already Exists!!']);
        }
        else{
            echo"Data is insert";
            $data = Class_data::find($id);
            // dd($data);
            $data->class_name = $request->classname;
            $data->subject_name = $request->subjectname;
            $data->teacher_id = $request->teachername;
            $data->save();

            return redirect("/showdata")->withSuccess('Data is Updated Successfully');
        }

    }
    public function deldata($id){
        // dd($id);
        $data = Class_data::find($id);
        $data->delete();
        return redirect("/showdata")->withSuccess('Data is Deleted Successfully');


    }

}
