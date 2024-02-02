<?php

namespace App\Http\Controllers;

use App\Models\Notice_Board_info;
use Illuminate\Http\Request;

class NoticeBoardInfoController extends Controller
{
    public function addnotice(){
        if(session()->has('email')){
            $role = session()->get('role');
            if($role == 1){
                $rname = "Principle";
                return view('add-notice',['rname'=>$rname]);
            }elseif($role == 2){
                $rname = "Teacher";
                return view('add-notice',['rname'=>$rname,]);
            }else{
                $rname = "Student";
                return view('add-notice',['rname'=>$rname]);
            }
        }
        else{
            return redirect('/');
        }

    }
    public function addnoticedata(Request $request){
        // dd($request->all());
        if(session()->has('email')){
            $request->validate([
                'message'=> 'required',
                'date'=> 'required',

            ]);

            $val= Notice_Board_info::where(['date'=>$request->date])->first();
            // dd($val);
            if($val !== null ){
                echo "Data is already Exists!!";
                return redirect('/show-noticedetails')->withErrors(['msg'=>'Date is already Exists!!']);
            }
            else{
                echo"Data is insert";
                $data = new Notice_Board_info();
                $data->Message = $request->message;
                $data->date = $request->date;
                $data->save();

                return redirect("/show-noticedetails")->withSuccess('Data is inserted Successfully');
            }

        }
        else{
            return redirect('/');
        }
    }
    public function shownoticedetails(){
        if(session()->has('email')){
            $email = session()->get('email');
            $role = session()->get('role');

            $val= Notice_Board_info::paginate(10);
            // dd($val);

            if($role == 1){
                $rname = "Principle";
                return view('shownoticedata',['rname'=>$rname,'val'=>$val]);
            }elseif($role == 2){
                $rname = "Teacher";
                return view('shownoticedata',['rname'=>$rname,'val'=>$val]);
            }else{
                $rname = "Student";
                return view('shownoticedata',['rname'=>$rname,'val'=>$val]);
            }
        }
        else{
            return redirect('/');
        }
    }
    public function editnoticedetails($id){
        // dd($id);
        if(session()->has('email')){
            $email = session()->get('email');
            $role = session()->get('role');

            $val= Notice_Board_info::find($id);
            // dd($val);

            if($role == 1){
                $rname = "Principle";
                return view('edit-notice',['rname'=>$rname,'val'=>$val]);

            }elseif($role == 2){
                $rname = "Teacher";
                return view('edit-notice',['rname'=>$rname,'val'=>$val]);

            }else{
                $rname = "Student";
                return view('edit-notice',['rname'=>$rname,'val'=>$val]);

            }
        }
        else{
            return redirect('/');
        }
    }
    public function updatenoticedetails(Request $request,$id){
        // dd($request->all(),$id);

        $chk = Notice_Board_info::where(['date'=>$request->date])->first();
        // dd($chk);
        if($chk == null){
            $val= Notice_Board_info::where(['Message'=>$request->message,'date'=>$request->date])->first();
            // dd($val);

            if($val !== null ){
                echo "Data is already Exists!!";
                return redirect('/show-noticedetails')->withErrors(['msg'=>'Date is already Exists!!']);
            }
            else{
                echo"Data is insert";
                    $data1 = Notice_Board_info::find($id);
                    $data1->Message = $request->message;
                    $data1->date = $request->date;
                    $data1->save();
                    return redirect("/show-noticedetails")->withSuccess('Data is Updated Successfully');

            }
        } else{
            // dd($chk->id);
            // echo "Date is already assigned";
            $data1 = Notice_Board_info::find($id);
            $data1->Message = $request->message;

            if($id == $chk->id)
            {
                $data1->date = $request->date;
                $data1->save();
                return redirect('/show-noticedetails')->withSuccess('Data is Updated Successfully');

            } else{
                $data1->save();
                return redirect('/show-noticedetails')->withErrors(['msg'=>'Date is already Exists!!']);

            }


        }


    }
    public function delnoticedetails($id){
        // dd($id);
        $data = Notice_Board_info::find($id);
        // dd($data);
        $data->delete();
        return redirect("/show-noticedetails")->withSuccess('Data is Deleted Successfully');

    }

}
