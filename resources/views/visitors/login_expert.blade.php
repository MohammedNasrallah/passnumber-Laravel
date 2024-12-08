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
      .modal-dialog
      {
        min-width: 60% !important;
      }
    </style>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row mt-2">
        <div class="col-md-4">
          <div class="image-holder-wrapper pb-3">
              
              <form id="myForm" action="{{ url('/login-new') }}" class="mt-3" method="post">
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
                        <input type="text" class="form-control" id="username" name="username" maxlength="30" placeholder="Username" minlength="4" value="{{ old('username') }}"/>
                      </td>
                  </tr>
                  <tr>
                    <td>
                      <label for="user_pass">Passnumber</label>
                    </td>
                    <td>
                      <input id="user_pass" class="form-control" type="text" name="password"  title="4 digits, no zeros, digits 1 to 4 only" placeholder="4 digits, no zeros, digits 1 to 4 only" value="{{ old('password') }}" />
                      <!-- <input id="user_pass" class="form-control" type="text" name="password" maxlength="4" pattern="[1-4]+"  title="4 digits, no zeros, digits 1 to 4 only" placeholder="4 digits, no zeros, digits 1 to 4 only" /> -->
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
                      <input type="submit" id="submit-button" name="submit" class="btn btn-success mt-3" value="Login" {{ @$retry_times>env('MINIMUM_ATTEMPT') ? 'disabled' : '' }}/>
                      <span class="btn span-help">Need help? <a href="#" data-toggle="modal" data-target="#passnumberTutorial">
                      Product Tour
                    </a></span>
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
                      <span class="d-block mb-3 pt-1 text-danger">Want to Retry? <a href="{{ url('/logout') }}">Logout</a></span> <br/>
                      Please share your feedback if you liked it. <a href="mailto:info@passnumber.com">info@passnumber.com</a>
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
                      <input type="submit" name="submit" class="btn btn-success mt-3" value="Login" {{ @$retry_times>env('MINIMUM_ATTEMPT') ? 'disabled' : '' }}  />
                      <span class="btn span-help">Need help? <a href="#" data-toggle="modal" data-target="#passnumberTutorial">
                      Product Tour
                    </a></span>
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
        
        <div class="col-md-8">
            <div id="image-holder">

              </div>
        </div>
      </div>  
    </div>
    @if(session('pass_reset_done'))
        <script>
          Swal.fire({
            icon: 'success',
            title: '{{ session("pass_reset_done_title") }}',
            text: 'Please share your feedback if you liked it.',
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



        <!-- Modal -->
<div class="modal fade" id="passnumberTutorial" tabindex="-1" role="dialog" aria-labelledby="passnumberTutorialTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">How to use PassNumber</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <video width="100%" height="auto" controls>
        <source src="{{ asset('/tutorial.mp4') }}" type="video/mp4">
      </video>
      </div>
    </div>
  </div>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('passnumber/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('passnumber/js/popper.min.js')}}"></script>
    <script src="{{ asset('passnumber/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('passnumber/js/index.js')}}"></script>
    <!-- <script type="text/javascript" src="{{ asset('passnumber/js/jquery.latest.min.js')}}" ></script> -->
    <!-- <script type="text/javascript" src="{{ asset('passnumber/js/passnumAjax.js')}}"></script> -->
    <script src="{{ asset('passnumber/js/jquery.fancybox.min.js')}}"></script>
    <!-- <script src="{{ asset('passnumber/js/jquery.passwordstrength.js')}}"></script> -->
    <script>
      function correctCaptcha() {
        
                
          $('input[type="submit"').removeAttr("disabled");
               
      };
    </script>
    <script>
      // Mode Changer
      $("#normal_mode").on('click', function(){
        $('.image-holder-wrapper').slideUp(500, function() {
          $('#traditional_mode').slideDown(500)
        }); 

        $("#image_mode_trigger").show(200);
        $("#normal_mode").hide(200);
      });

      $("#image_mode_trigger").on('click', function(){
        $('#traditional_mode').slideUp(500, function() {
          $('.image-holder-wrapper').slideDown(500)
        }); 

        $("#normal_mode").show(200);
        $("#image_mode_trigger").hide(200);
      });

      
      // Reloader
      $("#reload_img").on('click', function(){
        var username = $("#username").val();
        $('#image-holder').load('/login_gen/'+username);
      })

      $("#username").focusout(function(){
        var username = $("#username").val();
        console.log(username)
        $('#image-holder').load('/login_gen/'+username);
      });
    </script>
  </body>
</html>