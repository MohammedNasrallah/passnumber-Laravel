<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('passnumber/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('passnumber/css/all.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('passnumber/css/style.css')}}" />
    <script src="https://kit.fontawesome.com/e13f3fbd70.js" crossorigin="anonymous" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <title>PassNumber Method</title>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap');
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
      #regularpassholder
      {
        /* display: none; */
      }
      .col {
        padding: 2px 5px;
      }
      .modal-dialog
      {
        min-width: 60% !important;
      }
    </style>
        
  </head>
  <body>
    <div class="container-fluid">
      <div class="row mt-5">
       
        <div class="col-md-4 mx-auto">
          <div class="image-wrapper pb-3">
            
            
            
            <form id="myForm" action="{{ url('/signup-new') }}" class="mt-3" method="post">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="row-switcher">Select Rows</label>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <select id="row-switcher" name="rows" class="form-control">
                    <option value="4" selected>4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="from-group">
                  <label for="col-switcher">Select Cols</label>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <select id="col-switcher" name="cols" class="form-control">
                    <option value="4" selected>4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="username">Username:</label>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <div class="from-group">
                    <input type="text" class="form-control" id="username" name="username" maxlength="30" placeholder="username" value="{{ old('username') }}"/>
                    @if ($errors->has('username')) <span style="color:red;">{{ $errors->first('username') }}</span> @endif
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class="form-group">
                    <label for="usermail">Email:</label>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <div class="from-grou">
                    <input type="text" class="form-control" id="usermail" name="usermail" maxlength="30" placeholder="Email" value="{{ old('usermail') }}"/>
                    @if ($errors->has('usermail')) <span style="color:rgb(9, 245, 60);">{{ $errors->first('usermail') }}</span> @endif
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="userpass">Passnumber:</label>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <input type="text" class="form-control" id="userpass" name="password" maxlength="4" pattern="([1-4]+0[0-4]*|[0-4]*0[1-4]+)+" title="4 digits, 1 zero, digits 1-4 only" placeholder="Enter PassNumber" autocomplete="off" value="{{ old('password') }}" required />
                  @if ($errors->has('password')) <span style="color:red;">{{ $errors->first('password') }}</span> @endif
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label for="regularpass">Password:</label>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <input type="password" class="form-control" id="regularpass" name="regularpass" placeholder="Password" required minlength="8"/>
                  @if ($errors->has('regularpass')) <span style="color:red;">{{ $errors->first('regularpass') }}</span> @endif

                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="submit" id="submit-button" name="submit" class="btn btn-success mt-3" value="Create user" />
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <span class="btn span-help">Need help?
                    <a href="#" data-toggle="modal" data-target="#passnumberTutorial">
                      Product Tour
                    </a>
                  </span>
                </div>
              </div>
              @if(session('signup_done'))
                <div class="col-md-12">
                  <h5 class="bg-success text-center text-white border px-1 py-2"> Please confirm your email before login. </h5>
                </div>  
                @endif
              <div class="col-md-12">
                <div class="form-group">
                  <span class="d-block pt-1">Already have an account? <a href="{{ url('/login') }}">Login</a></span>
                </div>
              </div>
            </div>
            </form>
          </div>
        </div>
        <div class="col-md-8">
            <div id="image-holder">

            @foreach($images as $key=>$image)
              <div class="row mb-2">
              <?php $count = 0; ?>
                @foreach($image as $si_key=>$si_image)
                  <div class="{{ count($image)<=6 ? '' : '' }} position-relative">
                    <img src="{{ asset('/passnumber/images/allicons') }}/{{ $si_image }}" alt="" class="pass-icon">
                    <div class="number">
                    {{ $count+=1 }}
                    </div>
                  </div>
                @endforeach
              </div>
            @endforeach

          </div>
        </div>
        
      </div>
    </div>
    @if(session('signup_done'))
        <script>
          Swal.fire({
            icon: 'success',
            title: '{{ session("signup_done_title") }}',
            text: '{{ session("signup_done") }}',
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
    <!-- <script type="text/javascript" src="jquery.latest.min.js" ></script> -->
    <!-- <script type="text/javascript" src="new.passnumAjax.js"></script> -->

    <!-- 
      maxlength="4" pattern="[1-4]*0[1-4]*"
      title="4 digits, 1 zero, digits 1-4 only"
     -->
    <script>
      var userrows = 4;
      var usercols = 4;
      $( "#row-switcher" ).change(function() {
        userrows = $(this).val();
        // console.log(userrows);
        $("#userpass").removeAttr("maxlength");
        $("#userpass").removeAttr("minlength");
        $("#userpass").attr("maxlength",userrows);
        $("#userpass").attr("minlength",userrows);
        $("#userpass").removeAttr("pattern");
        $("#userpass").attr("pattern","([1-"+usercols+"]+0[0-"+usercols+"]*|[0-"+usercols+"]*0[1-"+usercols+"]+)+");
        $("#userpass").removeAttr("title");
        $("#userpass").attr("title",""+userrows+" digits, minimum 1 zero, digits 1-"+usercols+" only");



        $('#image-holder').load('/signup_gen/'+userrows+'/'+usercols);

      });
      $( "#col-switcher" ).change(function() {
        usercols = $(this).val();
        // console.log(usercols);
        $("#userpass").removeAttr("maxlength");
        $("#userpass").removeAttr("minlength");
        $("#userpass").attr("maxlength",userrows);
        $("#userpass").attr("minlength",userrows);
        $("#userpass").removeAttr("pattern");
        $("#userpass").attr("pattern","([1-"+usercols+"]+0[0-"+usercols+"]*|[0-"+usercols+"]*0[1-"+usercols+"]+)+");
        $("#userpass").removeAttr("title");
        $("#userpass").attr("title",""+userrows+" digits, minimum 1 zero, digits 1-"+usercols+" only");


        $('#image-holder').load('/signup_gen/'+userrows+'/'+usercols);

      });
    </script>
    <script src="{{ asset('passnumber/js/jquery.fancybox.min.js')}}"></script>
    <!-- <script src="{{ asset('passnumber/js/jquery.passwordstrength.js')}}"></script> -->

  </body>
</html>