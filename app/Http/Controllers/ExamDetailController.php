<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Class_data;
use App\Models\Class_info;
use App\Models\Exam_Detail;
use App\Models\Students_info;
use Illuminate\Http\Request;

class ExamDetailController extends Controller
{
    public function exam_assign(){
        if(session()->has('email')){
            $email = session()->get('email');
            $role = session()->get('role');
            // dd($role);
            if($role == 1){
                $rname = "Principle";
                return view('exam-assign',['rname'=>$rname]);
            }elseif($role == 2){
                $rname = "Teacher";
                $id = Admin::where('email',$email)->first();
                // dd($id->id);
                $classdetails = Class_data::where('teacher_id',$id->id)->distinct()->get();
                // dd($classdetails);
                return view('exam-assign',['rname'=>$rname,'classinfo'=>$classdetails,'id'=>$id]);
            }else{
                $rname = "Student";
                return view('exam-assign',['rname'=>$rname]);
            }
        }
        else{
            return redirect('/');
        }
    }
    public function addexam(Request $request){
        // dd($request->all());
        if(session()->has('email')){
            $request->validate([
                'classname'=> 'required',
                'date'=> 'required',
                'starttime'=> 'required',
                'endtime'=> 'required',

            ]);

            $classdata = $request->classname;
            // dd($classdata);
            $data = explode("_",$classdata);

            $email = session()->get('email');
            $id = Admin::where('email',$email)->first();

            $classname = $data[0];
            $subjectname = $data[1];
            $teachername = $id->id;
            $datename = $request->date;
            $starttime = $request->starttime;
            $endtime = $request->endtime;


            // dd($classname,$subjectname,$teachername,$datename,$starttime,$endtime);

            $val= Exam_Detail::where(['class_name'=>$classname,'subject_name'=>$subjectname,'teacher_name'=>$teachername,'date'=>$datename,'start_time'=>$starttime,'end_time'=>$endtime])->first();
            // dd($val);
            if($val !== null ){
                echo "Data is already Exists!!";
                return redirect('/show-examdetails')->withErrors(['msg'=>'Data is already Exists!!']);
            }
            else{
                echo"Data is insert";
                $data = new Exam_Detail();
                $data->class_name = $classname;
                $data->subject_name = $subjectname;
                $data->teacher_name = $teachername;
                $data->date = $datename;
                $data->start_time = $starttime;
                $data->end_time = $endtime;

                $data->save();

                return redirect("/show-examdetails")->withSuccess('Data is inserted Successfully');
            }

        }
        else{
            return redirect('/');
        }
    }
    public function showexamdetails(){

        if(session()->has('email')){
            $email = session()->get('email');
            $role = session()->get('role');

            $id= Admin::where('email',$email)->first();
            // dd($id->id);
            $val=Exam_Detail::where('teacher_name',$id->id)->paginate(10);

            if($role == 1){
                $rname = "Principle";
                return view('showexamdetails',['rname'=>$rname,'val'=>$val]);

            }elseif($role == 2){
                $rname = "Teacher";
                return view('showexamdetails',['rname'=>$rname,'val'=>$val]);


            }else{
                $rname = "Student";
                return view('showexamdetails',['rname'=>$rname,'val'=>$val]);

            }
        }
        else{
            return redirect('/');
        }
    }
    public function editexamdetails($id){
        // dd($id);
        if(session()->has('email')){
            $email = session()->get('email');
            $role = session()->get('role');

            $val= Exam_Detail::find($id);
            // dd($val);

            $name= Admin::where('email',$email)->first();
            // dd($name->id);

            $classdetails = Class_data::where('teacher_id',$name->id)->distinct()->get();
            // dd($classdetails);

            if($role == 1){
                $rname = "Principle";
                return view('edit-examdetails',['rname'=>$rname,'val'=>$val,'class'=>$classdetails]);

            }elseif($role == 2){
                $rname = "Teacher";
                return view('edit-examdetails',['rname'=>$rname,'val'=>$val,'class'=>$classdetails]);

            }else{
                $rname = "Student";
                return view('edit-examdetails',['rname'=>$rname,'val'=>$val,'class'=>$classdetails]);

            }
        }
        else{
            return redirect('/');
        }
    }
    public function updateexamdetails($id,Request $request){
        // dd($request->all(),$id);


       $classdata = $request->classname;
        // dd($classdata);
        $data = explode("_",$classdata);

        $email = session()->get('email');
        $email = Admin::where('email',$email)->first();

        $classname = $data[0];
        $subjectname = $data[1];
        $teachername = $email->id;
        $datename = $request->date;
        $starttime = $request->starttime;
        $endtime = $request->endtime;

        $val= Exam_Detail::where(['class_name'=>$classname,'subject_name'=>$subjectname,'teacher_name'=>$teachername,'date'=>$datename,'start_time'=>$starttime,'end_time'=>$endtime])->first();
        // dd($val);
        if($val !== null ){
            echo "Data is already Exists!!";
            return redirect('/show-examdetails')->withErrors(['msg'=>'Data is already Exists!!']);
        }
        else{
            echo"Data is insert";
            // dd($classname,$subjectname,$teachername,$datename,$starttime,$endtime);

            $data1 = Exam_Detail::find($id);
            // dd($data1);
            $data1->class_name = $classname;
            $data1->subject_name = $subjectname;
            // $data1->teacher_name = $teachername;
            $data1->date = $datename;
            $data1->start_time = $starttime;
            $data1->end_time = $endtime;

            $data1->save();

            return redirect("/show-examdetails")->withSuccess('Data is Updated Successfully');
        }

    }
    public function delexamdetails($id){
        // dd($id);
        $data = Exam_Detail::find($id);
        $data->delete();
        return redirect("/show-examdetails")->withSuccess('Data is Deleted Successfully');
    }
    public function showexamdata(){
        if(session()->has('email')){
            $email = session()->get('email');
            $role = session()->get('role');

            // $id= Admin::where('email',$email)->first();
            // dd($id->id);
            $val=Exam_Detail::paginate(10);

            if($role == 1){
                $rname = "Principle";
                return view('showexamdata',['rname'=>$rname,'val'=>$val]);

            }elseif($role == 2){
                $rname = "Teacher";
                return view('showexamdata',['rname'=>$rname,'val'=>$val]);


            }else{
                $rname = "Student";
                $id = Admin::where('email',$email)->first();
                $class = Students_info::where('student_id',$id->id)->first();
                // dd($class->class_name);

                if($class != null){
                    $data = Exam_Detail::where('class_name',$class->class_name)->paginate(5);
                    // dd($data);
                    return view('showexamdata',['rname'=>$rname,'val'=>$data]);
                }else{
                    $val1=0;
                    return view('showexamdata',['rname'=>$rname,'val'=>$val1]);
                }

            }
        }
        else{
            return redirect('/');
        }
    }

}
