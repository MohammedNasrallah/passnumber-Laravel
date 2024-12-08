<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SuperAdmin;
use App\Mail\AdminResetPassword;
use App\PassIcons;
use Mail;
use Str;
use Illuminate\Support\Facades\Validator;

class SuperAdminController extends Controller
{
    public function index()
	{
		$admins = SuperAdmin::get();
        if(count($admins)==0)
        {
            return redirect('/panel/superadmin/install');
        }
        else 
        {
        return view('admin.login');
        }
    }

    public function install()
    {
        $admins = SuperAdmin::get();
        if(count($admins)==0)
        {
            return view('admin.admin-install');
        }
        else 
        {
        return redirect('/panel/superadmin');
        }
    }

    public function dashboard()
    {
        $icons = PassIcons::select('pass_icons')->OrderBy('id','asc')->get();
        // $icons = explode("|",$icons);
        // return $icons[0]['pass_icons'];
		return view('admin.dash',compact('icons'));
    }

    public function row_details($id)
    {
        $icons = PassIcons::select('pass_icons')->where('id',$id)->first();
        $icons = $icons['pass_icons'];
        return view('admin.dash-icons',compact('icons','id'));
    }

    public function login_process(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'usermail' => 'required|email',
            // 'usermail' => 'required|email:rfc,dns',
            'password' => 'required|between:4,32',
        ]);
        if($validator->fails())
        {
            return $validator->errors();
        } else {
            $login_admin = [
                'email'	=> $request->usermail,
                'password'	=> $request->password,
            ];	 
            if (Auth()->guard('admins')->attempt($login_admin)) {
                return redirect(('/panel/superadmin/dashboard'));
            }else{
                return "User e-mail or password doesn'nt match";
            }   
        }
    }

    public function logout()
    {
    	
        if(!Auth()->guard('admins')->check()) 
        {
            return 'not logged in!';
        } else 
        {
            Auth()->guard('admins')->logout();
            return 'logout done';
        }
    }

    // Demo Logged in check
    public function is_logged_in()
    {
    	
        if(!Auth()->guard('admins')->check()) 
        {
            return 'not logged in!';
        } else 
        {
            return 'logged in';
        }
    }
    
    public function forgot_pass()
	{
		return view('admin.forgot-pass');
    }
    
	public function forgot_pass_process(Request $request)
    {
        $email       = $request->usermail;
        $verify_code = Str::random(40);
		$where = SuperAdmin::where(['email' => $email])->first();
        if (!empty($where)) {
            SuperAdmin::where(['email' => $email])->update(['forgot_code' => $verify_code, 'forgot_status' => '1']);
            Mail::to($email)->send(new AdminResetPassword($email, $verify_code));
            return 'Please Check your email inbox/spam.';
        } else
        {
            return 'Email Address does not exists';
        }
	}
	
	public function reset_pass(Request $request, $email, $code)
    {
        $findOrfail = SuperAdmin::where(['email' => $email, 'forgot_code' => $code, 'forgot_status' => '1'])->first();
        if (!empty($findOrfail)) {
            // return 'user found';
            return view('admin.reset-pass')->with(['email' => $email, 'code' => $code ]);
        }else{
            return 'Sorry! It seems like the link is expired!';
        }           
	}

	public function reset_pass_process(Request $request)
    {
        $email = $request->email;
        $code = $request->forgot_code;

        $findOrfail = SuperAdmin::where(['email' => $email, 'forgot_code' => $code, 'forgot_status' => '1'])->first();
        if (!empty($findOrfail)) {
            $validator = Validator::make($request->all(), [
                'password' => 'required|between:4,32|confirmed',
            ]);
            if($validator->fails())
            {
                return $validator->errors();
            } else {
                SuperAdmin::where(['email' => $email, 'forgot_code' => $code, 'forgot_status' => '1'])->update(['password' => bcrypt($request->password), 'forgot_code' => null, 'forgot_status' => null]);
                return 'Password Successfully Changed. You can now login.';
            }
        } else 
        {
            return 'Sorry Someting Went Wrong.';
        }

    }

    public function img_upload(Request $request)
    {
        // return $request->all();

        // $input=$request->all();
        $images= $request->pi_one;
        if($files=$request->file('row_one')){
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                $file->move('passnumber/images/allicons',$name);
                // $images[]=$name;
            }
        }


        /*Insert your data*/

        PassIcons::where('id',$request->row_no)->update( [
            'pass_icons'=>  implode("|",$images),
        ]);


        return back();
    }

    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'usermail' => 'required|email',
            // 'usermail' => 'required|email:rfc,dns',
            'userpass' => 'required|between:4,32',
        ]);
        if($validator->fails())
        {
            return $validator->errors();
        }
        else {
            $data = [
                'email' =>  $request->usermail,
                'password'  => bcrypt($request->userpass)
            ];
    
            SuperAdmin::insert($data);

            return redirect('/panel/superadmin');
        }
        
    }
}
