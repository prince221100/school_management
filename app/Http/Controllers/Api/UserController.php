<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\forgotmail;
use Illuminate\Http\Request;
use App\Models\Admin;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL as FacadesURL;
use Illuminate\Support\Str;
use PharIo\Manifest\Url;

use function Laravel\Prompts\confirm;

class UserController extends Controller
{
    public function register(Request $request){
        // echo "<pre>";
        // print_r($request->all());
        $valiator = validator($request->all(),[
            "firstname" => ['required'],
            "lastname" => ['required'],
            "role"=> ['required'],
            "mobileno"=>['required'],
            "email" => ['required','unique:admins,email'],
            "password"=>['required']

        ]);
        if($valiator->fails()){
            return response()->json($valiator->messages(),400);
        }else{
            DB::beginTransaction();
            try{
                $val = new Admin();
                $val->firstname = $request->firstname;
                $val->lastname = $request->lastname;
                $val->role = $request->role;
                $val->mobileno  = $request->mobileno;
                $val->email = $request->email;
                $val->password = $request->password;
                $val->save();
                $token = $val->createToken('Myapp')->accessToken;
                DB::commit();
            }
            catch(\Exception $e){
                DB::rollBack();
                $val = null;
            }
            if($val == null){
                return response()->json(
                    [
                        'message'=>'Internal Server Error',
                        'status'=>0,
                        'error'=>$e->getMessage()
                    ],500
                );
            }else{
                return response()->json(
                    [
                        'message'=>'Data inserted Successfully',
                        'status'=>1,
                        'token'=>$token,
                    ],200
                );
            }

        }
    }

    public function signin(Request $request){
        $validated = validator($request->all(),[
            "role"=> ['required'],
            "email" => ['required','email'],
            "password"=>['required']
        ]);
        if($validated->fails()){
            return response()->json($validated->messages(),400);
        }else{
            // DB::beginTransaction();
                $user1 =Admin::where([
                    'role'=>$request->role,
                    'email'=>$request->email,
                    'password'=>$request->password
                ])->first();

                if($user1 != null){
                // echo $user1;

                    $token = $user1->createToken('Token')->accessToken;;

                    return response()->json([
                        'message'=>"Login Successfully",
                        'status' => 1,
                        'token'=>$token
                    ],200);
                }
                else{
                    return response()->json([
                        'message'=>"Data is not match",
                        'status' => 0,
                    ],404);

                }
            }

    }

    public function userdetails(){
        // $users= Admin::find($id);

        // echo $users;
        if(Auth::guard('api')->check()){
            $users  = Auth::guard('api')->user();
            return response()->json([
                'message'=>'Profile Information',
                'status'=>1,
                'data'=>$users
            ],200);
        }

        return response()->json([
                'message'=>'Unauthorized User',
                'status'=>0

            ],401);

    }

    public function logout(){

        $user = Auth::guard('api')->user()->token();

        $user->revoke();

        return Response(['data' => 'Unauthorized','message' => 'User logout successfully.'],200);


    }

    public function forgot(Request $request){
        $validated = validator($request->all(),[
            'email' => 'required|email',
        ]);
        if($validated->fails()){
            return response()->json($validated->messages(),400);
        }
        else{
            $val = Admin::where('email',$request->email)->first();
            if($val == null){
                return response()->json(['message'=>'Email is not Found','status'=>0],401);
            }else{
                try{
                    $token=Str::random(40);
                    $store = DB::table('password_reset_tokens')->insert([
                        'email' => $request->email,
                        'token' => $token,
                        'created_at' => Carbon::now()
                    ]);

                    // $domain = URL::to('/');
                    $url= 'http://127.0.0.1:8000/api/reset_password?token='.$token;
                    $data['url']=$url;
                    $data['email']=$request->email;
                    $data['title']='Reset Password';
                    $data['body']='Please click on below link to reset your password.';
                    Mail::send('mailsend',['data'=>$data], function($message) use($data){
                    $message->to($data['email'])->subject($data['title']);
                    });


                    return response()->json(['message'=>'Send Reset Link in Your Mail','status'=>1,'token'=>$token,'url'=>$url],200);

                }
                catch(Exception $e){
                    return response()->json(['error'=>$e->getMessage(),'status'=>0 ],401);

                }
            }


        }

    }
    public function reset_password(Request $request){
        $token = $request->token;
        // echo $token;
        $validated = validator($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
            'Re-password' => 'required|same:password',
        ]);
        if($validated->fails()){
            return response()->json($validated->messages(),400);
        }
        else{

        $val = DB::table('password_reset_tokens')->where('token',$token)->first();
        // echo $val;
        if($val == null){
            return response()->json(['msg'=> 'You are unauthorized Person'],400);

        }else{
            // echo "Data updated";
                $upd = Admin::where('email',$request->email)->update(['password'=> $request->password]);

                DB::table('password_reset_tokens')->where('email',$request->email)->delete();
                return response()->json(['msg'=> 'Password Updated Successfully'],200);

            }


        }
    }

    public function profile(Request $request){
        $data = Auth()->guard('api')->user();
        // echo $data;
        $validated = validator($request->all(),[
            'firstname' => 'required',
            'lastname' => 'required',
            'mobileno' => 'required',
            'password' => 'required'

        ]);
        if($validated->fails()){
            return response()->json($validated->messages(),400);
        }else{


        if($data == null){
            return response()->json(['message'=>'You are Unauthorized User','status'=>0],401);
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


      }
    }



}
