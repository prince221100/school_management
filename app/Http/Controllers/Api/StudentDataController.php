<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentDataController extends Controller
{
    public function addstudent(Request $request){
        // echo "Add Student";
        $validated = validator($request->all(),[
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:admins,email',
            'mobileno' => 'required',
            'password' => 'required'

        ]);
        if($validated->fails()){
            return response()->json($validated->messages(),400);
        }
        else{
            DB::beginTransaction();
            // echo"Data Inserted";
            try{
                $val = new Admin();
                $val->firstname = $request->firstname;
                $val->lastname = $request->lastname;
                $val->email = $request->email;
                $val->role = 3;
                $val->mobileno = $request->mobileno;
                $val->password = $request->password;
                $val->save();
                DB::commit();
            }
            catch(Exception $e){
                DB::rollBack();
                $val = null;

            }
            if($val == null){
                return response()->json(['message'=>'Data is not inserted','status'=>0,'error'=>$e->getMessage()],401);

            }else{
                return response()->json(['message'=>'Data is inserted Successfully','status'=>1],200);

            }
        }
    }

    public function edit_studentdetails(Request $request, $id){
        $data = Admin::find($id);
        // echo($data->id);
        if($data){

            if ($data->role == 3){
                $validated = validator($request->all(),[
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'mobileno' => 'required',
                    'password' => 'required'

                ]);
                if($validated->fails()){
                    return response()->json($validated->messages(),400);
                }else{

                    DB::beginTransaction();
                    try{
                        $upd = Admin::find($data->id);
                        $upd->firstname = $request->firstname;
                        $upd->lastname = $request->lastname;
                        $upd->mobileno = $request->mobileno;
                        $upd->password = $request->password;
                        $upd->save();
                        DB::commit();
                    }
                    catch(Exception $e){
                        DB::rollBack();
                        $upd = null;
                    }
                    if($upd == null){
                        return response()->json(['message'=>'Data is not Updated','status'=>0,'error'=>$e->getMessage()],401);

                    }else{
                        return response()->json(['message'=>'Data is Updated Successfully','status'=>1],200);

                    }
                }

            }else{
                return response()->json(['message'=>'You are not right user','status'=>0],401);
            }
        }else{
            return response()->json(['message'=>'User is not Found','status'=>0],404);


        }
    }

    public function delete_studentdetails($id){
        $data = Admin::find($id);
        // echo($data->id);
        if($data){

            if ($data->role == 3){

                    DB::beginTransaction();
                    try{
                        $upd = Admin::find($data->id);
                        $upd->delete();
                        DB::commit();
                    }
                    catch(Exception $e){
                        DB::rollBack();
                        $upd = null;
                    }
                    if($upd == null){
                        return response()->json(['message'=>'Data is not Deleted','status'=>0,'error'=>$e->getMessage()],401);

                    }else{
                        return response()->json(['message'=>'Data is Deleted Successfully','status'=>1],200);

                    }


            }else{
                return response()->json(['message'=>'You are not right user','status'=>0],401);
            }
        }
    else{
            return response()->json(['message'=>'User is not Found','status'=>0],404);

        }
    }

    public function showstudent(){
        $data = Admin::where('role',3)->get();
        if($data){
            return response()->json(['message'=>'All Students Data','status'=>1,'data'=>$data],200);

        }
        else{
            return response()->json(['message'=>'User is not Found','status'=>0],404);

        }
    }


}
