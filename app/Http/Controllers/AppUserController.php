<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppUser;
use App\RegularPass;
use App\Mail\UserResetPassword;
use App\Mail\UserSignUp;
use App\PassIcons;
use Mail;
use Str;
use Session;
use Illuminate\Support\Facades\Validator;
// use App\Mail\ResetPilotPassword;
class AppUserController extends Controller
{
    public function index(Request $request)
	{
        // $signup_done = $request->signup_done;
		return view('visitors.registration');
    }

    public function expert_index(Request $request)
	{
        $items = $this->expert_gen(4,4);
        // dd($items);

        // Session::forget('signup_array');
        Session::put('signup_array', $items);

		return view('visitors.registration_expert')->with("images",$items);
    }

    public function expert_gen($rows,$cols)
	{

        $iconpack = PassIcons::orderBy('id','asc')->get();

        $_img_source = [];
        foreach($iconpack as $key=>$icons)
        {
            $explodeing = explode("|",$iconpack[$key]->pass_icons);

            $myar = '';
            foreach($explodeing as $item)
            {
                $myar .= $item.',';
            }

            array_push($_img_source,array(substr($myar, 0, -1)));
        }
        
        

        $parent_array = [
            array(
                "id"    =>  array(11,12,13,14,15,16,17,18,19),
                "img"   =>  $this->_pinu($_img_source[0])
            ),
            array(
                "id"    =>  array(21,22,23,24,25,26,27,28,29),
                "img"   =>  $this->_pinu($_img_source[1])
            ),
            array(
                "id"    =>  array(31,32,33,34,35,36,37,38,39),
                "img"   =>  $this->_pinu($_img_source[2])
            ),
            array(
                "id"    =>  array(41,42,43,44,45,46,47,48,49),
                "img"   =>  $this->_pinu($_img_source[3])
            ),
            array(
                "id"    =>  array(51,52,53,54,55,56,57,58,59),
                "img"   =>  $this->_pinu($_img_source[4])
            ),
            array(
                "id"    =>  array(61,62,63,64,65,66,67,68,69),
                "img"   =>  $this->_pinu($_img_source[5])
            ),
            array(
                "id"    =>  array(71,72,73,74,75,76,77,78,79),
                "img"   =>  $this->_pinu($_img_source[6])
            ),
            array(
                "id"    =>  array(81,82,83,84,85,86,87,88,89),
                "img"   =>  $this->_pinu($_img_source[7])
            ),
            array(
                "id"    =>  array(91,92,93,94,95,96,97,98,99),
                "img"   =>  $this->_pinu($_img_source[8])
            )
        ];













        /*
        // 

        $all = Session::get('signup_array');

        $pinu = [];
        foreach($_img_source[0] as $key=>$val)
        {
            array_push($pinu,$key);
        }
        // 

        $_parent_row = [];

        // dd($all);
        foreach($all as $key=>$val)
        {
            foreach($val as $k=>$v)
            {
                array_push($_parent_row,substr($k,0,1));
            }
        }

        $_dad_array = array_unique($_parent_row);

        // dd($_dad_array);
        $_new_parent = [];
        $_all_inc_session = [1,2,3,4,5,6,7,8,9];

        $_not_in_session = array_diff($_all_inc_session,$_dad_array);
        // 
        $kk = 0;
        $_child_col = "";
        $_child_col_key = "";
        foreach($_dad_array as $get_child)
        {
            $_prep = $all[$kk];
            // dd($_prep);
            foreach($_prep as $kkkk=>$vvvv)
            {
                $_child_col .= $vvvv.",";
                $_child_col_key .= $kkkk.",";
            }
            $_no_comma = substr($_child_col,0,-1);
            $_no_comma_key = substr($_child_col_key,0,-1);

            $_child_arr = explode(",",$_no_comma);
            $_child_key = explode(",",$_no_comma_key);

            $_survived_img = array_diff($parent_array[$get_child-1]["img"], $_child_arr);
            $_survived_img_ids = array_diff($parent_array[$get_child-1]["id"], $_child_key);

            $_num_id = '';
            $_num_val = '';
            foreach($_survived_img_ids as $_img_k=>$_img_v)
            {
                $_num_id .= $_img_v.',';
            }
            foreach($_survived_img as $_img_k=>$_img_v)
            {
                $_num_val .= $_img_v.',';
            }
            

            $_del_id_comma = substr($_num_id,0,-1);
            $_del_img_comma = substr($_num_val,0,-1);



            // $_del_id_comma = (int)$_del_id_comma;
            $_add_key_one = array_map('intval',explode(",",$_del_id_comma));
            $_add_key_two = explode(",",$_del_img_comma);

            // dd($_add_key_one);

            $_middle_arr = [
                "id"   => $_add_key_one,
                "img"  => $_add_key_two
            ];
            $_middle_arr2 = [];
            // array_push($_middle_arr,$_add_key_one);
            // array_push($_middle_arr2,$_add_key_two);

            // dd($_middle_arr);
            $_merging_new = array_combine($_add_key_one,$_add_key_two);

            array_push($_new_parent,$_middle_arr);
            // dd($_merging_new);


            $kk++;
        }


        // Getting unsessioned rows
        $_new_parent2 = [];
        foreach($_not_in_session as $nkey=>$nvalue)
        {
            array_push($_new_parent2,$parent_array[$nkey]);
        }

        $_combining_all = array_merge($_new_parent,$_new_parent2);
        dd($_combining_all);


        // dd(substr($_child_col,0,-1));




        //


        */
















        $items = array_slice($parent_array,0,$rows); // slice first $row items

        // Get Colomn // This will be from database in login screen
        $col_key = [0,$cols];
        $dumbarray = [];
        foreach($items as $key=>$row_data) {
            $slice_ids = array_slice($row_data['id'],$col_key[0],$col_key[1]);
            $slice_imgs = array_slice($row_data['img'],$col_key[0],$col_key[1]);
            $merging = array_combine($slice_ids,$slice_imgs);
            // $asshulf = $this->_pinu_shuffle_assoc($merging);
            array_push($dumbarray,$merging);
            // print_r($merging); 
        }
        // print_r($dumbarray);
        // shuffle($dumbarray);
		return $dumbarray;
    }

    public function expert_gen_req(Request $request,$rows, $cols)
	{
        $items = $this->expert_gen($rows,$cols);
        Session::put('signup_array', $items);

        return view('visitors.img_reload_expert')->with("images",$items);

        // return $items;
    }

    public function test_session()
    {
        $all = Session::get('signup_array');
        $_col_length = count($all[0]);
        // dd($_col_length);
        $_child_col = "";
        $_parent_row = [];

        // dd($all);
        foreach($all as $key=>$val)
        {
            foreach($val as $k=>$v)
            {
                array_push($_parent_row,substr($k,0,1));
            }
        }

        $_dad_array = array_unique($_parent_row);


        // dd($_dad_array);

        $_dad_to_child = [];
        $kk = 0;
        foreach($_dad_array as $get_child)
        {
            $_prep = $all[$kk];
            // dd($_prep);
            foreach($_prep as $kkkk=>$vvvv)
            {
                // array_push($_child_col,substr($kkkk,-1));
                // array_push($_child_col,$vvvv);
                $_child_col .= $vvvv.",";
            }

            $kk++;
        }

        dd(substr($_child_col,0,-1));
    }

    public function expert_index_process(Request $request)
    {
        // return $request->all();

        if($request->rows!=strlen($request->password))
        {
            return 'you did not fill every row!';

            
        }
        else 
        {
            $chars = str_split($request->password);

            if(max($chars)>$request->cols)
            {
                return 'you entered numbers which were not presented!';
            }
        }


        $messages = array(
            'usermail.unique' => 'The E-mail is already taken.',
            'usermail.required' => 'You must provide a valid E-mail.',
        );
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:4|max:32|unique:users,username',
            'usermail' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required',
            'regularpass'   =>  'required|min:8'
        ],$messages);
        if($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        } else {
            $verify_code = Str::random(40);
            $email       = strtolower($request->usermail);
            $user_login = trim(strtolower($request->username));
            $userPassnumber = trim($request->password);

            // Calculating the Icon IDs
            $session_data = Session::get('signup_array');

            $_pass_num = str_split($userPassnumber);

            $pass_icons = "";
            $zero = "";
            foreach($_pass_num as $key=>$pass)
            {
                if($pass>0)
                {
                    $pass -= 1;

                    $new = $session_data[$key];
                    $new = array_keys($new)[$pass];
                    // array_push($pass_icons,$new);
                    $pass_icons .= $new;

                } else 
                {
                    $new = $session_data[$key];
                    $new = array_keys($new)[$pass];
                    // $new .= 'X';
                    // array_push($dumb,$new);
                    $zero .= $new;
                }
            }
            $pvn = $this->reverse_saima($userPassnumber);
            $user_pass = bcrypt($pvn); 

            $data = [
                'username'      => $user_login,
                'email'         => $email,
                'password'      => bcrypt($user_login.'PassNumber'),
                'regularpass'   => bcrypt($request->regularpass),
                'pass_icons'    =>  $pass_icons,
                'pass_zero_ids' =>  $zero,
                'forgot_code'   => $verify_code,
                'is_verified' =>  0,
                'user_cols'     => $request->cols
            ];
            // return $pv; 

            
            $insert = AppUser::insert($data);
            if($insert)
            {
                Mail::to($email)->send(new UserSignUp($email, $verify_code));
                $signup_done = "Please verify your email.";
                $signup_done_title = "Registration Completed.";
                // return redirect()->route('signup',['signup_done'=>$signup_done]); 
                return redirect('/')->with(['signup_done'=>$signup_done,'signup_done_title'=>$signup_done_title]); 
    
            } else 
            {
                return false;
            }
        }
        
        // echo "<pre>";
        // print_r($dumb);
        // print_r(Session::get('signup_array'));

    }

    public function expert_login(Request $request)
    {
        $username = 'admin';
        $img = AppUser::select('pass_icons','pass_zero_ids','user_cols')->where('username',$username)->first();
        $splitting = str_split($img['pass_icons'],2);

        $retry_times = $request->session()->get('this_user_failed');
        if($retry_times>env('MINIMUM_ATTEMPT')){
            return view('visitors.login_expert')->with(compact('retry_times'));
        } else 
        {
		return view('visitors.login_expert');
        }
    }

    public function expert_login_process(Request $request)
    {
        $findOrfail = AppUser::select('is_verified', 'failed_attempts')->where(['username' => $request->username])->first();

        // return $request->session()->get('this_user_failed');

        // 
        if(empty($findOrfail))
        {
            $no_user = "User not found!";
            return back()->with('no_user',$no_user);
        } elseif (!empty($findOrfail) && $findOrfail->is_verified==0)
        {
            $no_verify = "User not verified.";
            return back()->with('no_verify',$no_verify);
        } elseif(!empty($findOrfail) && $findOrfail->failed_attempts>env('MAXIMUM_ATTEMPT'))
        {
            $reset_must = "You must reset your password!";
            return redirect('/forgot-password')->with('reset_must',$reset_must);
        } else 
        {
            $validator = Validator::make($request->all(), [
                'username' => 'required|min:4|max:32',
                // 'usermail' => 'required|email:rfc,dns|unique:users,email',
                'password' => 'required',
                // 'regularpass'   =>  'required|min:8'
            ]);
            if($validator->fails())
            {
                // return 'false';
                return back()->withInput()->withErrors($validator);
            } else {
                $user_login = trim(strtolower($request->username));
                $userPassnumber = trim($request->password);
                $user_icons = AppUser::select('pass_icons','pass_zero_ids','user_cols')->where('username',$user_login)->first();
                
                $pass_icon = str_split($user_icons['pass_icons'],2);
                $zero_icon = str_split($user_icons['pass_zero_ids'],2);
    
                // return $zero_icon;
    
                $zero_arr = [];
    
                foreach($zero_icon as $zero_odd)
                {
                    $single_item = substr($zero_odd,0,1);
                    array_push($zero_arr,$single_item);
                }
    
    
                // return $zero_arr;
                $db_icons = count($pass_icon);
                $db_zero = count($zero_icon);
    
                $db_arr = array_merge($pass_icon,$zero_icon);
                // dd($db_arr);
    
                // {"pass_icons":"423122","pass_zero_ids":"11","user_cols":"4"}
                // Calculating the Icon IDs
                $session_data = Session::get('login_array');

                $_pass_num = str_split($userPassnumber);
                
                $combo = $this->_row_gen($userPassnumber);
                
                if(count($combo) != count($session_data)) {
                    $pass_reset_error = "Please try again with caution.";
                    $pass_reset_error_title = "Wrong Password.";
                    return redirect('/login')->with(['pass_reset_error'=>$pass_reset_error,'pass_reset_error_title'=>$pass_reset_error_title]); 
                }
    
                // return $combo;
                $allResults = [];
                
                foreach($combo as $key=>$pass)
                {
                    $_pass_num = str_split($pass);
    
                    $user_arr = [];
    
                    // echo "1 <br/>";
                    foreach($_pass_num as $key=>$pass)
                    {
                    // echo "2 <br/>";
    
                        if($pass>0)
                        {
                            $pass -= 1;
    
                            $new = $session_data[$key];
                            $new = array_keys($new)[$pass];
                            // array_push($pass_icons,$new);
                            // $pass_icons .= $new;
                            array_push($user_arr,"$new");
                    // echo "2 <br/>";
    
    
                        } else 
                        {
                            $new = $session_data[$key];
                            $new = array_keys($new)[$pass];
                            // $new .= 'X';
                            // array_push($dumb,$new);
                            // $zero .= $new;
                        }
                    }
    
                    $output = $this->_login_helper($db_arr,$user_arr,$db_icons,$pass_icon,$_pass_num,$zero_arr);
    
                    array_push($allResults,$output);
                    
    
                }
                $login_admin = [
                    'username'	=> $user_login,
                    'password'	=> $user_login.'PassNumber',
                ];
                if(in_array("success",$allResults))
                {
        
                    if (Auth()->guard('appusers')->attempt($login_admin)) {
                        AppUser::where('username',$user_login)->update(['failed_attempts'=>0]);
                        session()->put('this_user_failed', 0);
        
                        // echo 'success'.'<br/>';
                    }
                } else 
                {
                    // return "error";
                }
                
                if(!Auth()->guard('appusers')->check()) 
                    {
                        $failed_attempts_data = AppUser::select('failed_attempts')->where('username',$user_login)->first();
                        $failed_attempts = $failed_attempts_data->failed_attempts+1;
                    
    
                        AppUser::where('username',$user_login)->update(['failed_attempts'=>$failed_attempts]);
    
                        session()->put('this_user_failed', $failed_attempts);
    
                        // return $failed_attempts;
                        $pass_reset_error = "Please try again with caution.";
                        $pass_reset_error_title = "Wrong Password.";
                        return redirect('/login')->with(['pass_reset_error'=>$pass_reset_error,'pass_reset_error_title'=>$pass_reset_error_title]); 
        
                    } else 
                    {
                        $pass_reset_done = "Congrates You are now logged in.";
                        $pass_reset_done_title = "Login Successful.";
                        return redirect('/login')->with(['pass_reset_done'=>$pass_reset_done,'pass_reset_done_title'=>$pass_reset_done_title]); 
                    }
            }
        }
        

    }

    public function expert_login_gen(Request $request,$username)
	{
        

        $user_dat = AppUser::select('pass_icons','pass_zero_ids','user_cols')->where('username',$username)->first();
        $user_cols = $user_dat['user_cols'];
        $pass = $user_dat['pass_icons'];
        $zero = $user_dat['pass_zero_ids'];
        //  New Codes
        $item_pr = [];
        $_ready_saima = $this->_db_to_img($user_cols,$pass);
        $_zero_saima = $this->_db_to_img($user_cols,$zero);

        $merging = array_merge($_ready_saima,$_zero_saima);
        shuffle($merging);
        // dd($merging);
        // Will Create a f
        // return $_ready_saima;
        Session::forget('login_array');
        Session::put('login_array', $merging);

        return view('visitors.login_load_expert')->with("images",$merging);
    }

    public function login(Request $request)
	{
        $retry_times = $request->session()->get('this_user_failed');
        if($retry_times>env('MINIMUM_ATTEMPT')){
            return view('visitors.login')->with(compact('retry_times'));
        } else 
        {
		return view('visitors.login');
        }
    }

    public function login_process(Request $request)
    {
        $findOrfail = AppUser::select('is_verified', 'failed_attempts')->where(['username' => $request->username])->first();

        // return $request->session()->get('this_user_failed');

        // 
        if(empty($findOrfail))
        {
            $no_user = "User not found!";
            return back()->with('no_user',$no_user);
        } elseif (!empty($findOrfail) && $findOrfail->is_verified==0)
        {
            $no_verify = "User not verified.";
            return back()->with('no_verify',$no_verify);
        } elseif(!empty($findOrfail) && $findOrfail->failed_attempts>env('MAXIMUM_ATTEMPT'))
        {
            $reset_must = "You must reset your password!";
            return redirect('/forgot-password')->with('reset_must',$reset_must);
        } else 
        {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required|min:4|max:4',
            ]);
            if($validator->fails())
            {
                return $validator->errors();
            } else {
                // Narallah's Code
                session_start();
                $user_login = trim($request->username);
                $userChain = trim($request->password);
    
                $user_array = str_split($userChain);
                //All forms possibilites of passchains to be entered (the cmbination of 4 digites with any 1 entry)
                $ps1 = '1110';
                $ps2 = '1101';
                $ps3 = '1011';
                $ps4 = '0111';
    
                $passchainsArray = array('ps1', 'ps2', 'ps3', 'ps4');
    
                //The pass number arrays data, those appeared to the user randomly.
                $passNumberArrays = array(
                    $_SESSION['_values'][$_SESSION['showKeys'][0]],
                    $_SESSION['_values'][$_SESSION['showKeys'][1]],
                    $_SESSION['_values'][$_SESSION['showKeys'][2]],
                    $_SESSION['_values'][$_SESSION['showKeys'][3]]
                );
    
                // dd($_SESSION['showKeys']);
                // return $passNumberArrays;
                foreach ($passchainsArray as $k => $ps) {
                    $psNumber = "{$$ps}";    
                    for ($i = 0; $i < 4; $i++) {
                        $result[$i] = $psNumber[$i] * $user_array[$i];
        
                    }
                    $passchain = $result;
                    
                    //The first sequence calculation to check the given passnumber.
                    $sequence0 = array( ($passNumberArrays[0][$_SESSION['showSubArray0'][$passchain[0]]]),
                                        ($passNumberArrays[1][$_SESSION['showSubArray1'][$passchain[1]]]),
                                        ($passNumberArrays[2][$_SESSION['showSubArray2'][$passchain[2]]]),
                                        ($passNumberArrays[3][$_SESSION['showSubArray3'][$passchain[3]]]));
                                      
                    $total = array_sum($sequence0);
                    $zerosPs = array_keys($sequence0, "0"); 
                    $zero_rows = (($passNumberArrays[$zerosPs[0]][4])); 
                    // $hashed_result = sha1($total + $zero_rows);
                    
                    $nohashed_result=($total + $zero_rows); 
                    // echo $nohashed_result.'<br/>';
    
                    // return $nohashed_result;
                    //The second sequence calculation to check the given passnumber.
                    $sequence1 = array( ($passNumberArrays[1][$_SESSION['showSubArray1'][$passchain[0]]]),
                    ($passNumberArrays[2][$_SESSION['showSubArray2'][$passchain[1]]]),
                    ($passNumberArrays[3][$_SESSION['showSubArray3'][$passchain[2]]]),
                    ($passNumberArrays[0][$_SESSION['showSubArray0'][$passchain[3]]]));
            
                    $total1 = array_sum($sequence1);
                    $zerosPs1 = array_keys($sequence1, "0"); 
    
                    $passNumberArrays1 = array( $_SESSION['_values'][$_SESSION['showKeys'][1]],
                                    $_SESSION['_values'][$_SESSION['showKeys'][2]],
                                    $_SESSION['_values'][$_SESSION['showKeys'][3]],
                                    $_SESSION['_values'][$_SESSION['showKeys'][0]]);
                                    
                    $zero_rows1 = (($passNumberArrays1[$zerosPs1[0]][4])); 
                    $nohashed_result1 = ($total1 + $zero_rows1);
                    // echo $nohashed_result1.'<br/>';
    
    
                    //The third sequence calculation to check the given passnumber.
                    $sequence2 = array( ($passNumberArrays[2][$_SESSION['showSubArray2'][$passchain[0]]]),
                    ($passNumberArrays[3][$_SESSION['showSubArray3'][$passchain[1]]]),
                    ($passNumberArrays[0][$_SESSION['showSubArray0'][$passchain[2]]]),
                    ($passNumberArrays[1][$_SESSION['showSubArray1'][$passchain[3]]]));
                
                    $total2 = array_sum($sequence2);
                    $zerosPs2 = array_keys($sequence2, "0"); 
    
                    $passNumberArrays2 = array( $_SESSION['_values'][$_SESSION['showKeys'][2]],
                                        $_SESSION['_values'][$_SESSION['showKeys'][3]],
                                        $_SESSION['_values'][$_SESSION['showKeys'][0]],
                                        $_SESSION['_values'][$_SESSION['showKeys'][1]]);
                                        
    
                    $zero_rows2 = (($passNumberArrays2[$zerosPs2[0]][4])); 
                    $nohashed_result2 = ($total2 + $zero_rows2);
                    // echo $nohashed_result2.'<br/>';
    
                    //The fourth sequence calculation to check the given passnumber.
                    $sequence3 = array( ($passNumberArrays[3][$_SESSION['showSubArray3'][$passchain[0]]]),
                    ($passNumberArrays[0][$_SESSION['showSubArray0'][$passchain[1]]]),
                    ($passNumberArrays[1][$_SESSION['showSubArray1'][$passchain[2]]]),
                    ($passNumberArrays[2][$_SESSION['showSubArray2'][$passchain[3]]]));
                
                    $total3 = array_sum($sequence3);
                    $zerosPs3 = array_keys($sequence3, "0"); 
    
                    $passNumberArrays3 = array( $_SESSION['_values'][$_SESSION['showKeys'][3]],
                                        $_SESSION['_values'][$_SESSION['showKeys'][0]],
                                        $_SESSION['_values'][$_SESSION['showKeys'][1]],
                                        $_SESSION['_values'][$_SESSION['showKeys'][2]]);
                                        
    
                    $zero_rows3 = (($passNumberArrays3[$zerosPs3[0]][4])); 
                    $nohashed_result3 = ($total3 + $zero_rows3);
                    // echo $nohashed_result3.'<br/>';
                    // Narallah's Code Ends
    
                    // My Customization
                    $login_admin = [
                        'username'	=> $user_login,
                        'password'	=> $nohashed_result,
                    ];	 
                    $login_admin1 = [
                        'username'	=> $user_login,
                        'password'	=> $nohashed_result1,
                    ];	  
                    $login_admin2 = [
                        'username'	=> $user_login,
                        'password'	=> $nohashed_result2,
                    ];	  
                    $login_admin3 = [
                        'username'	=> $user_login,
                        'password'	=> $nohashed_result3,
                    ];	  
                    if (Auth()->guard('appusers')->attempt($login_admin) || Auth()->guard('appusers')->attempt($login_admin1) || Auth()->guard('appusers')->attempt($login_admin2) || Auth()->guard('appusers')->attempt($login_admin3)) {
                        AppUser::where('username',$user_login)->update(['failed_attempts'=>0]);
                        session()->put('this_user_failed', 0);

                        // echo 'success'.'<br/>';
                    }
                    else {
                        // echo 'false'.'<br/>';
                    }
                    // My Custom Ends
                }
                if(!Auth()->guard('appusers')->check()) 
                {
                    $failed_attempts_data = AppUser::select('failed_attempts')->where('username',$user_login)->first();
                    $failed_attempts = $failed_attempts_data->failed_attempts+1;

                

                    AppUser::where('username',$user_login)->update(['failed_attempts'=>$failed_attempts]);

                    session()->put('this_user_failed', $failed_attempts);

                    // return $failed_attempts;
                    $pass_reset_error = "Please try again with caution.";
                    $pass_reset_error_title = "Wrong Password.";
                    return redirect('/login')->with(['pass_reset_error'=>$pass_reset_error,'pass_reset_error_title'=>$pass_reset_error_title]); 
    
                } else 
                {
                    $pass_reset_done = "Congrates You are now logged in.";
                    $pass_reset_done_title = "Login Successful.";
                    return redirect('/login')->with(['pass_reset_done'=>$pass_reset_done,'pass_reset_done_title'=>$pass_reset_done_title]); 
                }
                
            }
        }


        
    }

    public function login_process_regular(Request $request)
    {
        $findOrfail = AppUser::select('is_verified', 'failed_attempts')->where(['username' => $request->username])->first();

        // return $request->session()->get('this_user_failed');

        // 
        if(empty($findOrfail))
        {
            $no_user = "User not found!";
            return back()->with('no_user',$no_user);
        } elseif (!empty($findOrfail) && $findOrfail->is_verified==0)
        {
            $no_verify = "User not verified.";
            return back()->with('no_verify',$no_verify);
        } elseif(!empty($findOrfail) && $findOrfail->failed_attempts>env('MAXIMUM_ATTEMPT'))
        {
            $reset_must = "You must reset your password!";
            return redirect('/forgot-password')->with('reset_must',$reset_must);
        } else 
        {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'regular_pass' => 'required|min:6',
            ]);
            if($validator->fails())
            {
                return $validator->errors();
            } else {  
                    $userinfo = [
                        'username'	=> $request->username,
                        'password'	=> $request->regular_pass,
                    ];	  
                    // return $userinfo;
                    $username = $request->username;
                    // return $userinfo;
                    $gt_hash = AppUser::select('regularpass')->where('username',$username)->first();
                    // return $gt_hash;
                
                    
                    if (Auth()->guard('regularpass')->attempt($userinfo)) {
                        // return 'true';
                        AppUser::where('username',$username)->update(['failed_attempts'=>0]);
                        session()->put('this_user_failed', 0);

                        $pass_reset_done = "Congrates You are now logged in.";
                        $pass_reset_done_title = "Login Successful.";
                        return redirect('/login')->with(['pass_reset_done'=>$pass_reset_done,'pass_reset_done_title'=>$pass_reset_done_title]); 
                    }
                    else {
                        // return 'false';
                        $failed_attempts_data = AppUser::select('failed_attempts')->where('username',$username)->first();
                        $failed_attempts = $failed_attempts_data->failed_attempts+1;

                        AppUser::where('username',$username)->update(['failed_attempts'=>$failed_attempts]);

                        session()->put('this_user_failed', $failed_attempts);

                        // return $failed_attempts;
                        $pass_reset_error = "Please try again with caution.";
                        $pass_reset_error_title = "Wrong Password.";
                        return redirect('/login')->with(['pass_reset_error'=>$pass_reset_error,'pass_reset_error_title'=>$pass_reset_error_title]); 
                    }
                }
                
            
        }
    }

    public function logout()
    {
    	
        if(Auth()->guard('appusers')->check()) 
        {
            Auth()->guard('appusers')->logout();
            Auth()->guard('regularpass')->logout();
            return redirect('/login');

        } elseif(Auth()->guard('regularpass')->check())
        {
            Auth()->guard('appusers')->logout();
            Auth()->guard('regularpass')->logout();
            return redirect('/login');

        } else
        {
            return 'not logged in';
        }
    }

    // Demo Logged in check
    public function is_logged_in()
    {
    	
        if(Auth()->guard('appusers')->check()) 
        {
            return 'logged in appuser!';
        } elseif(Auth()->guard('regularpass')->check())
        {
            return 'logged in regularpass!';
        }
        else 
        {
            return 'not logged in';
        }
    }
    
    public function signup(Request $request)
	{
        // return $request->all();
        $messages = array(
            'usermail.unique' => 'The E-mail is already taken.',
            'usermail.required' => 'You must provide a valid E-mail.',
        );
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:4|max:32|unique:users,username',
            'usermail' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|min:4|max:4',
            'regularpass'   =>  'required|min:8'
        ],$messages);
        if($validator->fails())
        {
            return back()->withErrors($validator);
        } else {
            $verify_code = Str::random(40);
            $email       = strtolower($request->usermail);
            $user_login = trim(strtolower($request->username));
            $userPassnumber = trim($request->password);
            // Narallah's Code
            /* $user_login = trim(strtolower($request->username));
            $userPassnumber = trim($request->password);
            $passnumber = str_split($userPassnumber);
			$_values = array(
				array(0,1,2,3,4), // 1
				array(0,10,20,30,40), // 2
				array(0,100,200,300,400), // 3
				array(0,1000,2000,3000,4000), // 4

			);
            $password_value = ($_values[0][$passnumber[0]]) + ($_values[1][$passnumber[1]]) + ($_values[2][$passnumber[2]])+ ($_values[3][$passnumber[3]]) ; 
            $zerosPs = array_keys($passnumber, "0"); // get the position of zero
            // return $zerosPs;
            // return $_values[3][$passnumber[3]];
            $zeroz_rows = (end($_values[$zerosPs[0]])); // 
            // return $password_value;
            $pv = ($password_value + $zeroz_rows);

            $pvn = $this->reverse_saima($userPassnumber); // my one liner to do 355-369 codes work

            return $pv.$pvn;*/
            

            // Nasrallah's code's end
            $pvn = $this->reverse_saima($userPassnumber);
            $user_pass = bcrypt($pvn); 

            $data = [
                'username'      => $user_login,
                'email'         => $email,
                'password'      => $user_pass,
                'regularpass'   => bcrypt($request->regularpass),
                'forgot_code'   => $verify_code,
                'is_verified' =>  0
            ];
            // return $pv; 

            
            $insert = AppUser::insert($data);
            if($insert)
            {
                Mail::to($email)->send(new UserSignUp($email, $verify_code));
                $signup_done = "Please verify your email.";
                $signup_done_title = "Registration Completed.";
                // return redirect()->route('signup',['signup_done'=>$signup_done]); 
                return redirect('/')->with(['signup_done'=>$signup_done,'signup_done_title'=>$signup_done_title]); 
    
            } else 
            {
                return false;
            }
        }
    }

    public function verify_user($email, $code)
    {
        $findOrfail = AppUser::where(['email' => $email, 'forgot_code' => $code, 'is_verified' => '0'])->first();
        if (!empty($findOrfail)) {
            AppUser::where(['email' => $email])->update(['forgot_code' => null, 'is_verified' => '1']);
            
            $pass_reset_done = "You can now login.";
            $pass_reset_done_title = "Email Verified!";
            return redirect('/login')->with(['pass_reset_done'=>$pass_reset_done,'pass_reset_done_title'=>$pass_reset_done_title]); 
            
        }else{
            $pass_reset_error = "The link seems to be expired or invalid.";
            $pass_reset_error_title = "Invalid Link.";
            return redirect('/login')->with(['pass_reset_error'=>$pass_reset_error,'pass_reset_error_title'=>$pass_reset_error_title]); 
        }  

    }

	public function forgot_pass()
	{
		return view('visitors.forgot-pass');
	}
	public function forgot_pass_process(Request $request)
    {
        $email       = $request->usermail;
        $verify_code = Str::random(40);
        $where = AppUser::where(['email' => $email])->first();
        $time = \Carbon\Carbon::now();
        
        if (!empty($where)) {
            AppUser::where(['email' => $email])->update(['forgot_code' => $verify_code, 'forgot_status' => '1', 'last_attempt' => $time]);
            $username       = $where->username;
            Mail::to($email)->send(new UserResetPassword($email, $username, $verify_code));
            $pass_reset_done = "Check your email to reset password.";
            $pass_reset_done_title = "Reset mail sent.";
            return redirect('/login')->with(['pass_reset_done'=>$pass_reset_done,'pass_reset_done_title'=>$pass_reset_done_title]); 
        } else
        {
            $pass_reset_error = "There is no email associated with this email.";
            $pass_reset_error_title = "Email not found.";
            return redirect('/login')->with(['pass_reset_error'=>$pass_reset_error,'pass_reset_error_title'=>$pass_reset_error_title]); 
        }
	}
	
	public function reset_pass(Request $request, $email, $code)
    {
        $present = \Carbon\Carbon::now();
        $findOrfail = AppUser::where(['email' => $email, 'forgot_code' => $code, 'forgot_status' => '1'])->first();
        $items = $this->expert_gen(4,4);
        // return $items;

        Session::forget('signup_array');
        Session::put('signup_array', $items);

        if (!empty($findOrfail)) {
            $past = $findOrfail->last_attempt;
            $diff_in_hours = $present->diffInHours($past);
            if($diff_in_hours>=24)
            {
                $pass_reset_error = "The link seems to be expired.";
                $pass_reset_error_title = "Link Expired!";
                return redirect('/login')->with(['pass_reset_error'=>$pass_reset_error,'pass_reset_error_title'=>$pass_reset_error_title]); 
            } else {
                return view('visitors.reset_expert')->with(['email' => $email, 'code' => $code, 'images' => $items ]);
            }
        }else{
            $pass_reset_error = "The link seems to be expired or invalid.";
            $pass_reset_error_title = "Invalid Link.";
            return redirect('/login')->with(['pass_reset_error'=>$pass_reset_error,'pass_reset_error_title'=>$pass_reset_error_title]); 
        }           
	}

	public function reset_pass_process(Request $request)
    {
        // return $request->all();
        $user_login = trim(strtolower($request->email));
        $code = $request->forgot_code;
        $present = \Carbon\Carbon::now();
        $combined = 5;
        $findOrfail = AppUser::where(['email' => $user_login, 'forgot_code' => $code, 'forgot_status' => '1'])->first();
        if (!empty($findOrfail)) {
            $past = $findOrfail->last_attempt;
            $diff_in_hours = $present->diffInHours($past);
            if($diff_in_hours>=24)
            {
                $pass_reset_error = "The link seems to be expired.";
                $pass_reset_error_title = "Link Expired!";
                return redirect('/login')->with(['pass_reset_error'=>$pass_reset_error,'pass_reset_error_title'=>$pass_reset_error_title]); 
            } else {
                
                $new_str = str_replace(' ', '', $request->regularpass);
                $messages = array(
                    'password.required' => 'You must enter a valid password.',
                    'regularpass.min' => 'Password must be at least 8 character long.',
                );
                if(strlen($new_str)>0)
                {
                    $validator = Validator::make($request->all(), [
                        'password' => 'required|min:4|max:9',
                        'regularpass' => 'required|min:8',
                    ],$messages);
                    // return "0 great";
                } else 
                {
                    $validator = Validator::make($request->all(), [
                        'password' => 'required|min:4|max:9',
                    ]);
                    $combined = 0;
                    // return "below 0";
                }
                if($validator->fails())
                {
                    return back()->withInput()->withErrors($validator);
                } else {

                    // Registration Codes
                    if($request->rows!=strlen($request->password))
                    {
                        return 'you did not fill every row!';
                    }
                    else 
                    {
                        $chars = str_split($request->password);
            
                        if(max($chars)>$request->cols)
                        {
                            return 'you entered numbers which were not presented!';
                        }
                    }
                    $validator = Validator::make($request->all(), [
                        'password' => 'required|min:4|max:9',
                        'regularpass'   =>  'required|min:8'
                    ]);
                    if($validator->fails())
                    {
                        return back()->withErrors($validator);
                    } else {
                        
                        $user_login = trim(strtolower($request->email));
                        $userPassnumber = trim($request->password);
            
                        // Calculating the Icon IDs
                        $session_data = Session::get('signup_array');
            
                        $_pass_num = str_split($userPassnumber);
            
                        $pass_icons = "";
                        $zero = "";
                        foreach($_pass_num as $key=>$pass)
                        {
                            if($pass>0)
                            {
                                $pass -= 1;
            
                                $new = $session_data[$key];
                                $new = array_keys($new)[$pass];
                                // array_push($pass_icons,$new);
                                $pass_icons .= $new;
            
                            } else 
                            {
                                $new = $session_data[$key];
                                $new = array_keys($new)[$pass];
                                // $new .= 'X';
                                // array_push($dumb,$new);
                                $zero .= $new;
                            }
                        }
                        $user_pass = bcrypt($findOrfail->username.'PassNumber');  
                        
                        if($combined==0)
                        {
                            AppUser::where(['email' => $user_login, 'forgot_code' => $code, 'forgot_status' => '1'])->update(['password' => $user_pass,'pass_icons' => $pass_icons,'pass_zero_ids' =>  $zero,'user_cols' => $request->cols, 'forgot_code' => null, 'forgot_status' => null, 'is_verified'=>1,'last_attempt'=>null,'failed_attempts'=>0]);
                        } else 
                        {
                            AppUser::where(['email' => $user_login, 'forgot_code' => $code, 'forgot_status' => '1'])->update(['password' => $user_pass,'regularpass'=>bcrypt($request->regularpass), 'pass_icons' => $pass_icons,'pass_zero_ids' =>  $zero,'user_cols' => $request->cols,'forgot_code' => null, 'forgot_status' => null, 'is_verified'=>1,'last_attempt'=>null,'failed_attempts'=>0]);
                        }
                        
                        $pass_reset_done = "You can now login.";
                        $pass_reset_done_title = "Password Reset Done.";
                        return redirect('/login')->with(['pass_reset_done'=>$pass_reset_done,'pass_reset_done_title'=>$pass_reset_done_title]);
                        }

                    // Registration Expert ends
                     
                }
            }
        } else 
        {
            $pass_reset_error = "The link seems to be expired or invalid.";
            $pass_reset_error_title = "Invalid Link.";
            return redirect('/login')->with(['pass_reset_error'=>$pass_reset_error,'pass_reset_error_title'=>$pass_reset_error_title]); 
        }

    }



    /* All of illusionist3886's custom functions*/
    function reverse_saima($password)
   {
       $length = strlen($password);
       return $pinu = strrev(str_replace(0,$length,$password)); 
   }
   //  ## string to array
    function _pinu($saim)
    {
        $data = explode(",",$saim[0]);
        return $data;
    }
    // inspired from https://www.w3resource.com/php-exercises/php-array-exercise-26.php
    function _pinu_shuffle_assoc($input)
    {
        $parent_keys = array_keys($input);
        shuffle($parent_keys);
        foreach($parent_keys as $new_key) {
            $new[$new_key] = $input[$new_key];
        }
        $input = $new;
        return $input;
    }

    // DB to Image
    function _db_to_img($user_cols,$pass)
    {

        $iconpack = PassIcons::orderBy('id','asc')->get();

        $_img_source = [];
        foreach($iconpack as $key=>$icons)
        {
            $explodeing = explode("|",$iconpack[$key]->pass_icons);

            $myar = '';
            foreach($explodeing as $item)
            {
                $myar .= $item.',';
            }

            array_push($_img_source,array(substr($myar, 0, -1)));
        }
        

        $parent_array = [
            array(
                "id"    =>  array(11,12,13,14,15,16,17,18,19),
                "img"   =>  $this->_pinu($_img_source[0])
            ),
            array(
                "id"    =>  array(21,22,23,24,25,26,27,28,29),
                "img"   =>  $this->_pinu($_img_source[1])
            ),
            array(
                "id"    =>  array(31,32,33,34,35,36,37,38,39),
                "img"   =>  $this->_pinu($_img_source[2])
            ),
            array(
                "id"    =>  array(41,42,43,44,45,46,47,48,49),
                "img"   =>  $this->_pinu($_img_source[3])
            ),
            array(
                "id"    =>  array(51,52,53,54,55,56,57,58,59),
                "img"   =>  $this->_pinu($_img_source[4])
            ),
            array(
                "id"    =>  array(61,62,63,64,65,66,67,68,69),
                "img"   =>  $this->_pinu($_img_source[5])
            ),
            array(
                "id"    =>  array(71,72,73,74,75,76,77,78,79),
                "img"   =>  $this->_pinu($_img_source[6])
            ),
            array(
                "id"    =>  array(81,82,83,84,85,86,87,88,89),
                "img"   =>  $this->_pinu($_img_source[7])
            ),
            array(
                "id"    =>  array(91,92,93,94,95,96,97,98,99),
                "img"   =>  $this->_pinu($_img_source[8])
            )
        ];

        $splitting = str_split($pass,2);

        $item_pr = [];
        foreach($splitting as $key=>$value)
        {
            $array_number = substr($value,0,1);
            
            $array_number -= 1;

            $_pr = $parent_array[$array_number];

            $slice_ids = array_slice($_pr['id'],0,$user_cols);
            $slice_imgs = array_slice($_pr['img'],0,$user_cols);
            $merging = array_combine($slice_ids,$slice_imgs);

            $user_value = $merging["$value"];
            unset($merging[$value]);
            $shuffled = $this->_pinu_shuffle_assoc($merging);
            $grab_items = array_slice($shuffled, 0, $user_cols, true);
            $grab_items[$value] = $user_value;

            $final_shuffle = $this->_pinu_shuffle_assoc($grab_items);

            array_push($item_pr,$final_shuffle);

        }

        return $item_pr;
    }

    function _login_helper($db_arr,$user_arr,$db_icons,$pass_icon,$_pass_num,$zero_arr)
    {
        $result = array_intersect($db_arr,$user_arr);
        if(count($result)>=$db_icons)
        {
            // return $user_arr;
            $find_diff = array_diff($pass_icon,$user_arr);
            if(count($find_diff)==0)
            {
                $get_user_zero = array_diff($_pass_num,$pass_icon);

                $user_zero_arr = [];

                foreach($get_user_zero as $zero_odd)
                {
                    $single_item = substr($zero_odd,0,1);
                    array_push($user_zero_arr,$single_item);
                }

                $compare_zero = array_diff($user_zero_arr,$zero_arr);
                if($compare_zero)
                {
                    return "success";
                }
                else {
                    return "false";
                }

            } else 
            {
                return "false";
            }
        } else 
        {
            return "false";
        }
    }

    function _pinu_combomaker($userPassnumber)
    {
        $combo = [];
        $temp = '';
        function ShobKichuPrintKoro($s, $left, $right) 
        { 
            if ($left == $right) 
            {
                // echo $s. "\n"; 
                array_push($GLOBALS['combo'],$s);
            }
            else
            { 
                for ($i = $left; $i <= $right; $i++) 
                { 
                    $s = balerSwap($s, $left, $i); 
                    ShobKichuPrintKoro($s, $left + 1, $right); 
                    $s = balerSwap($s, $left, $i); 
                } 
            } 
        } 
        
        function balerSwap($s, $i, $j) 
        { 
            global $temp; 
            $c = str_split($s); 
            $temp = $c[$i] ; 
            $c[$i] = $c[$j]; 
            $c[$j] = $temp; 
            return implode($c); 
        } 
        
        $s = $userPassnumber; 
        $len = strlen($s); 
        ShobKichuPrintKoro($s, 0, $len - 1); 
        $out = array_unique($combo);
        return $out;
    }

    function _row_gen($data)
    {
        $len = strlen($data);
        $abd = [];
        for($i=1;$i<=$len;$i++)
        {
            $first = substr($data,0,1);
            $last = substr($data,1,$len);

            $data = $last.$first;
            array_push($abd,$data);
        }
        return $abd;
    }
}
