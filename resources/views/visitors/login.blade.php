<?php
header('Cache-Control: no-store, private, no-cache, must-revalidate'); header('Cache-Control: pre-check=0, post-check=0, max-age=0, max-stale = 0', false);
header('Pragma: public');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); 
header('Expires: 0', false); 
header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
header ('Pragma: no-cache');
// //try
/*An authentication process is disclosed which uses categories of icons
to create an easy to remember passnumber for use with an electronic platform.
The process may assign each icon a discrete value during registration.
A hash value is created based on combining the discrete values for each icon in the passnumber. 
During a login process, the user is presented with the icons, sometimes in a randomly shuffled.
The user may input the icons that make up his or her passnumber. 
The process may access stored values for user selected icons in the login passnumber entry field
and calculate a login hash value. The process may then determine whether the login hash value matches
the registration hash value to permit or deny login access to the electronic platform.

    Copyright (C) 2020 Mohammed Nasrallah

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.
 Contact us at passnumber.com or email us at: info@passnumber.com*/
 ;?>

<?php session_start();?>
<?php
  unset($_SESSION['_values']);
  unset($_SESSION['showKeys']);
  unset($_SESSION['showSubArray0']);
  unset($_SESSION['showSubArray1']);
  unset($_SESSION['showSubArray2']);
  unset($_SESSION['showSubArray3']);
?>
<?php
//Login assistant file

function sub_array_keys($_symbols) {
    $result = array();
    foreach ($_symbols as $key => $sub_array) {
        $result[$key] = array_keys($sub_array);
    }return $result;}
    
        function customShuffle(array &$_symbols) {
    $firstElement = array_shift($_symbols);
    shuffle($_symbols);
    array_unshift($_symbols, $firstElement);
}


function shuffle_assoc(&$_symbols) {
    $keys = array_keys($_symbols);

    shuffle($keys);

    foreach ($keys as $key) {
        $new[$key] = $_symbols[$key];
    }

    $_symbols = $new;

    return true;
}


function sort_sub_array_by_array($_symbols, $_keys) {
    $result = array();
    foreach ($_keys as $key_1 => $sub_array_keys) {
        foreach ($sub_array_keys as $key_2) {
            $result[$key_1][$key_2] = $_symbols[$key_1][$key_2];
        }
    }
    return $result;
}
    
    
?>
    
 <?php $user_login = ""; $userChain = "";  'user_login' == ""; 'user_pass' == ""; ?>

<?php

$_values = array( 
array(0, 1, 2, 3, 4), // 0
array(0, 10, 20, 30, 40), // 1
array(0, 100, 200, 300, 400), // 2
array(0, 1000, 2000, 3000, 4000), // 3
);



$_symbols = array(
  array(0,'<img src="passnumber/images/foodicons/food-1.jpg" width="50" height="50"/>','<img src="passnumber/images/foodicons/food-2.jpg" width="50" height="50"/>','<img src="passnumber/images/foodicons/food-3.jpg" width="50" height="50"/>','<img src="passnumber/images/foodicons/food-4.jpg" width="50" height="50"/>'), //0
  array(0,'<img src="passnumber/images/fruitsicons/fruites-1.jpg" width="50" height="50"/>','<img src="passnumber/images/fruitsicons/fruites-2.jpg" width="50" height="50"/>','<img src="passnumber/images/fruitsicons/fruites-3.jpg" width="50" height="50"/>','<img src="passnumber/images/fruitsicons/fruites-4.jpg" width="50" height="50"/>'), //1
  array(0,'<img src="passnumber/images/animalsicons/animal-1.jpg" width="50" height="50"/>','<img src="passnumber/images/animalsicons/animal-2.jpg" width="50" height="50"/>','<img src="passnumber/images/animalsicons/animal-3.jpg" width="50" height="50"/>','<img src="passnumber/images/animalsicons/animal-4.jpg" width="50" height="50"/>'), //2
  array(0,'<img src="passnumber/images/jobsicons/job-1.jpg" width="50" height="50"/>','<img src="passnumber/images/jobsicons/job-2.jpg" width="50" height="50"/>','<img src="passnumber/images/jobsicons/job-3.jpg" width="50" height="50"/>','<img src="passnumber/images/jobsicons/job-4.jpg" width="50" height="50"/>'), //3
  );


// Shuffling both of arrays ($_symbols and $_values) once to get a consistent shuffled arrays.
$_keys = sub_array_keys($_symbols);

array_walk($_keys, function(&$_keys) { customShuffle($_keys);});

shuffle_assoc($_keys);

$_symbols = sort_sub_array_by_array($_symbols, $_keys);
$_values = sort_sub_array_by_array($_values, $_keys);

$showKeys = array_keys($_symbols);

$showSubArray0 = array_keys($_symbols[$showKeys[0]]);
$showSubArray1 = array_keys($_symbols[$showKeys[1]]);
$showSubArray2 = array_keys($_symbols[$showKeys[2]]);
$showSubArray3 = array_keys($_symbols[$showKeys[3]]);

$_SESSION['_values'] = $_values;
$_SESSION['showKeys'] = $showKeys;
$_SESSION['showSubArray0'] = $showSubArray0;
$_SESSION['showSubArray1'] = $showSubArray1;
$_SESSION['showSubArray2'] = $showSubArray2;
$_SESSION['showSubArray3'] = $showSubArray3;

// echo "<pre>";
// print_r($_SESSION);
// exit();

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('passnumber/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('passnumber/css/style.css')}}" />
    <link rel="stylesheet" href="{{ asset('passnumber/css/all.min.css')}}" />
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <title>PassNumber Method</title>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap');
      .invalid {
        color:red;
      }
      .valid {
        color: green;
      }
      .condition {
        font-family: Roboto;
        text-align: justify
      }
      .span-help
      {
        margin-top: 15px;
      }
      .light-grey
      {
        background: #f0f0f0;
      }
      .g-recaptcha {
    margin-top: 10px;
    text-align: center;
}
.g-recaptcha>div {
    width: 100% !important;
}
      .fa-info-circle {
        color:red;
        /* color: white; */
      }
      .fa-check-circle {
        /* color: white;  */
        color: green;
      }
      .condition i.fa-check-circle, .condition i.fa-info-circle
      {
        display:none;
      }
      .condition.valid > .fa-check-circle, .condition.invalid > .fa-info-circle
      {
        display: inline-block !important;
      }
      .condition {
        font-family: Roboto;
        text-align: justify
      }
      .span-help
      {
        margin-top: 15px;
      }
      input.pinu {
          border: none;
          color: #007BFF;
      }
      #traditional_mode, #image_mode_trigger
      {
        display: none;
      }
      #normal_mode, #image_mode_trigger
      {
        padding: 3px 5px;
      }
      #normal_mode:hover, #image_mode_trigger:hover {
        cursor: pointer
      }

    </style>
    <link rel="stylesheet" href="{{ asset('passnumber/css/jquery.fancybox.min.css')}}" />
  </head>
  <body>
    <div class="container-fluid">
      <div class="row mt-2">
        <div class="col-md-6 pl-5">
        <div id="warnings" class="bg-white pl-5 pt-3 pr-5 pb-3">
            <p class="req">Validation Rules</p>
            <p class="condition username" id="pinux0">
            <i class="fas fa-check-circle"></i>
              <i class="fas fa-info-circle"></i>
              1. Enter your Username 
            </p> 
            <p class="condition digit" id="pinux1"> 
            <i class="fas fa-check-circle"></i>
              <i class="fas fa-info-circle"></i>
              2. You need to represent your passnumber by entering the locations of your memorized icons (e.g. if the first row has “Fish plate” at location “3”, you need to enter “3” at the passnumber field.
            </p>
            <p class="condition digit-two" id="pinux2"> 
            <i class="fas fa-check-circle"></i>
              <i class="fas fa-info-circle"></i>
              3. Next row, if it was the neglected category, just enter any deceiving digits from 1-4 but not zero. Otherwise, enter the correct location number of your icon.
            </p>
            <p class="condition digit-three" id="pinux3"> 
            <i class="fas fa-check-circle"></i>
              <i class="fas fa-info-circle"></i>
              4. If the next category is fruits, then represent your “Apple” location by entering its number, I mean again, if it was at location “4”, you need to enter “4”.
            </p>
            <p class="condition limited" id="pinux4">
            <i class="fas fa-check-circle"></i>
              <i class="fas fa-info-circle"></i>
              5. Moving forward until you enter 4 numbers of passnumber not including Zeros.
            </p>
            <p class="condition login">
              
              6.	Let say your resulting passnumber is “3142”, then the script will test it and match it with the saved stored password in database. If matched, you login successfully.
            </p>
            <p class="condition loggedin">
              7.	Try to change the number that representing the neglected category, you will login successfully again!
            </p>
            <p class="condition text-warning">
              8.	Try to enter your passnumber starting from any row, downward or upward, you will login successfully if you did represent your icons' locations correctly (You always should complete a full cycle of categories regardless the direction or starting and ending category until you enter 4 digits passnumber).
            </p>
            <p class="condition text-warning"> 
              9.	Refresh the table to test PassNumber again.
            </p>
            <p class="condition text-warning">
              10.	It’s not embarrassing at all to have some fun here, also 
            </p>
          </div>
        </div>
        <div class="col-md-6 pl-5">
          <div class="image-holder pb-3 pl-5">
            <?php 
                $_symbols = array(
                  array(0,'<img src="passnumber/images/foodicons/food-1.jpg" width="84" height="84"/>','<img src="passnumber/images/foodicons/food-2.jpg" width="84" height="84"/>','<img src="passnumber/images/foodicons/food-3.jpg" width="84" height="84"/>','<img src="passnumber/images/foodicons/food-4.jpg" width="84" height="84"/>'), //0
                  array(0,'<img src="passnumber/images/fruitsicons/fruites-1.jpg" width="84" height="84"/>','<img src="passnumber/images/fruitsicons/fruites-2.jpg" width="84" height="84"/>','<img src="passnumber/images/fruitsicons/fruites-3.jpg" width="84" height="84"/>','<img src="passnumber/images/fruitsicons/fruites-4.jpg" width="84" height="84"/>'), //1
                  array(0,'<img src="passnumber/images/animalsicons/animal-1.jpg" width="84" height="84"/>','<img src="passnumber/images/animalsicons/animal-2.jpg" width="84" height="84"/>','<img src="passnumber/images/animalsicons/animal-3.jpg" width="84" height="84"/>','<img src="passnumber/images/animalsicons/animal-4.jpg" width="84" height="84"/>'), //2
                  array(0,'<img src="passnumber/images/jobsicons/job-1.jpg" width="84" height="84"/>','<img src="passnumber/images/jobsicons/job-2.jpg" width="84" height="84"/>','<img src="passnumber/images/jobsicons/job-3.jpg" width="84" height="84"/>','<img src="passnumber/images/jobsicons/job-4.jpg" width="84" height="84"/>'), //3
                  );
            ?>
            <div id="image_mode">
              <table id="userArrayTable">
                <tr>
                  <td><?php echo $_symbols[$showKeys[0]][$showSubArray0[1]] ?><span>1</span></td>
                  <td><?php echo $_symbols[$showKeys[0]][$showSubArray0[2]] ?><span>2</span></td>
                  <td><?php echo $_symbols[$showKeys[0]][$showSubArray0[3]] ?><span>3</span></td>
                  <td><?php echo $_symbols[$showKeys[0]][$showSubArray0[4]] ?><span>4</span></td>
                </tr>
                <tr id="tr2">
                  <td><?php echo $_symbols[$showKeys[1]][$showSubArray1[1]] ?><span>1</span></td>
                  <td><?php echo $_symbols[$showKeys[1]][$showSubArray1[2]] ?><span>2</span></td>
                  <td><?php echo $_symbols[$showKeys[1]][$showSubArray1[3]] ?><span>3</span></td>
                  <td><?php echo $_symbols[$showKeys[1]][$showSubArray1[4]] ?><span>4</span></td>
                </tr>
                <tr>
                  <td><?php echo $_symbols[$showKeys[2]][$showSubArray2[1]] ?><span>1</span></td>
                  <td><?php echo $_symbols[$showKeys[2]][$showSubArray2[2]] ?><span>2</span></td>
                  <td><?php echo $_symbols[$showKeys[2]][$showSubArray2[3]] ?><span>3</span></td>
                  <td><?php echo $_symbols[$showKeys[2]][$showSubArray2[4]] ?><span>4</span></td>
                </tr>
                <tr id="tr4">
                  <td><?php echo $_symbols[$showKeys[3]][$showSubArray3[1]] ?><span>1</span></td>
                  <td><?php echo $_symbols[$showKeys[3]][$showSubArray3[2]] ?><span>2</span></td>
                  <td><?php echo $_symbols[$showKeys[3]][$showSubArray3[3]] ?><span>3</span></td>
                  <td><?php echo $_symbols[$showKeys[3]][$showSubArray3[4]] ?><span>4</span></td> 
                </tr>
              </table>
              <form id="myForm" action="{{ url('/login') }}" class="mt-3" method="post">
              {{ csrf_field() }}
                <table style="width:346px">
                    <tr class="mb-2 d-block">
                      <td colspan="2">
                        <button type="button" class="btn btn-danger" id="reload_img">Reload Images</button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label for="username">Username</label>
                      </td>
                      <td>
                        <input type="text" class="form-control" id="username" name="username" maxlength="30" placeholder="Username" minlength="4"/>
                      </td>
                  </tr>
                  <tr>
                    <td>
                      <label for="user_pass">Passnumber</label>
                    </td>
                    <td>
                      <input id="user_pass" class="form-control" type="text" name="password" maxlength="4" pattern="[1-4]+"  title="4 digits, no zeros, digits 1 to 4 only" placeholder="4 digits, no zeros, digits 1 to 4 only" />
                    </td> 
                  </tr> <!-- Another usefull pattern is 0{1}[1-4]{3}|[1-4]{1}0{1}[1-4]{2}|[1-4]{2}0{1}[1-4]{1}|[1-4]{3}0{1} -->
                  <tr>
                    <td colspan="2">
                      @if(@$retry_times>env('MINIMUM_ATTEMPT'))
                        @if(env('GOOGLE_RECAPTCHA_KEY'))
                            <div class="g-recaptcha"data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}" data-callback="correctCaptcha">
                            </div>
                        @endif
                      @endif
                    </td>
                  </tr>
                  <tr>	
                    <td colspan="2"> 
                      <input type="submit" id="submit-button" name="submit" class="btn btn-success mt-3" value="Login" disabled />
                      <span class="btn span-help">Need help? <a data-fancybox="gallery" href="{{ asset('passnumber/images/tour/step-1.png')}}"><input type="submit" class="pinu" name="submit" value="Product Tour" /></a></span>
                    </td>
                  </tr>
                  <tr>	
                    <td colspan="2"> 
                      <span class="d-block pt-1">Don't have an account? <a href="{{ url('/') }}">Sign Up</a></span>
                    </td>
                  </tr>
                  <tr>	
                    <td colspan="2"> 
                      @if(!Auth()->guard('appusers')->check())
                      <span class="d- pt-1 text-danger">Forgot Password? <a href="{{ url('/forgot-password') }}">Reset</a></span>
                      <span id="normal_mode" class="border border-primary rounded">Password Mode</span>
                      @endif
                      @if(Auth()->guard('appusers')->check() OR Auth()->guard('regularpass')->check())
                      <span class="d- pt-1 text-danger">Want to Retry? <a href="{{ url('/logout') }}">Logout</a></span>
                      @endif
                    </td>
                  </tr>
                </table>
              </form>
            </div>
            <div id="traditional_mode">
              <form id="myForm" action="{{ url('/login_regular') }}" class="mt-3" method="post">
                {{ csrf_field() }}
                <table style="width:346px">
                    <tr>
                      <td>
                        <label for="username">Username</label>
                      </td>
                      <td>
                        <input type="text" class="form-control" id="username" name="username" maxlength="30" placeholder="Username" minlength="4"/>
                      </td>
                  </tr>
                  <input type="hidden" name="mode"  value="_traditional">
                  <tr>
                    <td>
                      <label for="regular_pass">Password</label>
                    </td>
                    <td>
                      <input id="regular_pass" name="regular_pass" class="form-control" type="password" name="password" minlength="8" placeholder="Password" />
                    </td> 
                  </tr> <!-- Another usefull pattern is 0{1}[1-4]{3}|[1-4]{1}0{1}[1-4]{2}|[1-4]{2}0{1}[1-4]{1}|[1-4]{3}0{1} -->
                  <tr>
                    <td colspan="2">
                      @if(@$retry_times>env('MINIMUM_ATTEMPT'))
                        @if(env('GOOGLE_RECAPTCHA_KEY'))
                            <div class="g-recaptcha"data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}" data-callback="correctCaptcha">
                            </div>
                        @endif
                      @endif
                    </td>
                  </tr>
                  <tr>	
                    <td colspan="2"> 
                      <input type="submit" name="submit" class="btn btn-success mt-3" value="Login" />
                      <span class="btn span-help">Need help? <a data-fancybox="gallery" href="{{ asset('passnumber/images/tour/step-1.png')}}"><input type="submit" class="pinu" name="submit" value="Product Tour" /></a></span>
                    </td>
                  </tr>
                  <tr>	
                    <td colspan="2"> 
                      <span class="d-block pt-1">Don't have an account? <a href="{{ url('/') }}">Sign Up</a></span>
                    </td>
                  </tr>
                  <tr>	
                    <td colspan="2"> 
                      @if(!Auth()->guard('appusers')->check() OR !Auth()->guard('regularpass')->check())
                      <span class="d- pt-1 text-danger">Forgot Password? <a href="{{ url('/forgot-password') }}">Reset</a></span>
                      <span id="image_mode_trigger" class="border border-primary rounded">PassNumber Mode</span>

                      @endif
                      @if(Auth()->guard('appusers')->check() OR Auth()->guard('regularpass')->check())
                      <span class="d- pt-1 text-danger">Want to Retry? <a href="{{ url('/logout') }}">Logout</a></span>
                      @endif
                    </td>
                  </tr>
                </table>
              </form>
            </div>    
          </div>
        </div>
      </div>
    </div>
    @if(session('pass_reset_done'))
        <script>
          Swal.fire({
            icon: 'success',
            title: '{{ session("pass_reset_done_title") }}',
            text: '{{ session("pass_reset_done") }}',
          })
        </script>
    @endif
   
    @if(session('no_user'))
        <script>
          Swal.fire({
            icon: 'error',
            text: '{{ session("no_user") }}',
          })
        </script>
    @endif
    @if(session('no_verify'))
        <script>
          Swal.fire({
            icon: 'error',
            text: '{{ session("no_verify") }}',
          })
        </script>
    @endif
    @if(session('pass_reset_error'))
        <script>
          Swal.fire({
            icon: 'error',
            title: '{{ session("pass_reset_error_title") }}',
            text: '{{ session("pass_reset_error") }}',
          })
        </script>
    @endif
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('passnumber/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('passnumber/js/popper.min.js')}}"></script>
    <script src="{{ asset('passnumber/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('passnumber/js/index.js')}}"></script>
    <!-- <script type="text/javascript" src="{{ asset('passnumber/js/jquery.latest.min.js')}}" ></script> -->
    <!-- <script type="text/javascript" src="{{ asset('passnumber/js/passnumAjax.js')}}"></script> -->
    <script src="{{ asset('passnumber/js/jquery.fancybox.min.js')}}"></script>
    <script src="{{ asset('passnumber/js/jquery.passwordstrength.js')}}"></script>
    <script>
      function correctCaptcha() {
        $('input[type=text]').on('input',function(e){
                setTimeout(function(){ 
                  if($("#pinux0").hasClass("valid") && $("#pinux1").hasClass("valid") && $("#pinux2").hasClass("valid") && $("#pinux3").hasClass("valid") && $("#pinux4").hasClass("valid"))
                  {
                    $('input#submit-button').removeAttr("disabled");
                  } else {
                    $('input#submit-button').attr("disabled","true");
                  }
                }, 400);
              });

              if($("#pinux0").hasClass("valid") && $("#pinux1").hasClass("valid") && $("#pinux2").hasClass("valid") && $("#pinux3").hasClass("valid") && $("#pinux4").hasClass("valid"))
                  {
                    $('input#submit-button').removeAttr("disabled");
                  } else {
                    $('input#submit-button').attr("disabled","true");
                  }
      }

      var status;
      $(function(){
          $('input#user_pass').loginpasswordstrength();
          $('input#username').usernamevalidation();
          
          @if(@$retry_times<env('MINIMUM_ATTEMPT'))
              $('input[type=text]').on('input',function(e){
                setTimeout(function(){ 
                  if($("#pinux0").hasClass("valid") && $("#pinux1").hasClass("valid") && $("#pinux2").hasClass("valid") && $("#pinux3").hasClass("valid") && $("#pinux4").hasClass("valid"))
                  {
                    $('input#submit-button').removeAttr("disabled");
                  } else {
                    $('input#submit-button').attr("disabled","true");
                  }
                }, 400);
              });
          @endif

          
      });
    </script>
    <script>
      // Mode Changer
      $("#normal_mode").on('click', function(){
        $('#image_mode').slideUp(500, function() {
          $('#traditional_mode').slideDown(500)
        }); 

        $("#image_mode_trigger").show(200);
        $("#normal_mode").hide(200);
      });

      $("#image_mode_trigger").on('click', function(){
        $('#traditional_mode').slideUp(500, function() {
          $('#image_mode').slideDown(500)
        }); 

        $("#normal_mode").show(200);
        $("#image_mode_trigger").hide(200);
      });

      
      // Reloader
      $("#reload_img").on('click', function(){
        $('#userArrayTable').load('/reload_image');
      })
    </script>
    <a data-fancybox="gallery" href="{{ asset('passnumber/images/tour/step-2.png')}}"></a>
      <a data-fancybox="gallery" href="{{ asset('passnumber/images/tour/step-3.png')}}"></a> 
  </body>
</html>