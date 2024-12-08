<?php
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
    </style>
    <link rel="stylesheet" href="{{ asset('passnumber/css/jquery.fancybox.min.css')}}" />
        
  </head>
  <body>
    <div class="container-fluid">
      <div class="row mt-5">
        <div class="col-md-6 pl-5">
          <div id="warnings" class="bg-white pl-5 pt-3 pr-5 pb-3">
            <p class="req">Validation Rules</p>

            <p class="condition digit" id="pinux0"> 
            <i class="fas fa-check-circle"></i>
              <i class="fas fa-info-circle"></i>
              1. Chose 1 icon from each category starting from the first row/category and enter its location number only (e.g. enter “1” for “Fish plate”)
            </p>
            <p class="condition digit-two" id="pinux1"> 
            <i class="fas fa-check-circle"></i>
              <i class="fas fa-info-circle"></i>
              2. Repeat the previous step for next rows 2 and 3. (E.g. enter again “1” for “Apple” and enter again “1” for “Cow”.
            </p>
            <p class="condition zero" id="pinux2">
            <i class="fas fa-check-circle"></i>
              <i class="fas fa-info-circle"></i>
               3. Enter “0” to represent nothing from row 4 (You should forget (neglect) 1 row/category and represent that by entering "0". E.g. if you selected “Fish plate” and “Apple” then “Cow” and you won’t any icons from the last category, simply enter passnumber: 1110).
            </p>
            <p class="condition maxrange" id="pinux3">
            <i class="fas fa-check-circle"></i>
              <i class="fas fa-info-circle"></i>
              4. It is up to you to neglect any category of above by replacing its location number by “0”. One category only to be neglected. Try it.</p>
            <p class="condition limited" id="pinux4"> 
            <i class="fas fa-check-circle"></i>
              <i class="fas fa-info-circle"></i>
              5. Insert Only 0-4 numbers
            </p>
            <p class="condition indexlogin">
            <i class="fas fa-check-circle"></i>
              <i class="fas fa-info-circle"></i>
              6. You only need to memorize your icons, not the passnumber! Did you memorize the icons of yours?</p>
          </div>
        </div>
        <div class="col-md-6 pl-5">
          <div class="image-holder pb-3 pl-5">
            <?php
                $_symbols = array(
                  array(0,'<img src="'.url('/').'/passnumber/images/foodicons/food-1.jpg" width="84" height="84"/>','<img src="'.url('/').'/passnumber/images/foodicons/food-2.jpg" width="84" height="84"/>','<img src="'.url('/').'/passnumber/images/foodicons/food-3.jpg" width="84" height="84"/>','<img src="'.url('/').'/passnumber/images/foodicons/food-4.jpg" width="84" height="84"/>'), //0
                  array(0,'<img src="'.url('/').'/passnumber/images/fruitsicons/fruites-1.jpg" width="84" height="84"/>','<img src="'.url('/').'/passnumber/images/fruitsicons/fruites-2.jpg" width="84" height="84"/>','<img src="'.url('/').'/passnumber/images/fruitsicons/fruites-3.jpg" width="84" height="84"/>','<img src="'.url('/').'/passnumber/images/fruitsicons/fruites-4.jpg" width="84" height="84"/>'), //1
                  array(0,'<img src="'.url('/').'/passnumber/images/animalsicons/animal-1.jpg" width="84" height="84"/>','<img src="'.url('/').'/passnumber/images/animalsicons/animal-2.jpg" width="84" height="84"/>','<img src="'.url('/').'/passnumber/images/animalsicons/animal-3.jpg" width="84" height="84"/>','<img src="'.url('/').'/passnumber/images/animalsicons/animal-4.jpg" width="84" height="84"/>'), //2
                  array(0,'<img src="'.url('/').'/passnumber/images/jobsicons/job-1.jpg" width="84" height="84"/>','<img src="'.url('/').'/passnumber/images/jobsicons/job-2.jpg" width="84" height="84"/>','<img src="'.url('/').'/passnumber/images/jobsicons/job-3.jpg" width="84" height="84"/>','<img src="'.url('/').'/passnumber/images/jobsicons/job-4.jpg" width="84" height="84"/>'), //3
                  );
            ?>
            <table id="userArrayTable" >

              <tr>
              <td><?php echo $_symbols[0][1] ?><span>1</span></td> <td><?php echo $_symbols[0][2] ?><span>2</span></td> <td><?php echo $_symbols[0][3] ?><span>3</span></td> <td><?php echo $_symbols[0][4] ?><span>4</span></td> 
              </tr>
              <tr id="tr2">
              <td><?php echo $_symbols[1][1] ?><span>1</span></td> <td><?php echo $_symbols[1][2] ?><span>2</span></td> <td><?php echo $_symbols[1][3] ?><span>3</span></td> <td><?php echo $_symbols[1][4] ?><span>4</span></td>  	
              </tr>
              <tr>
              <td><?php echo $_symbols[2][1] ?><span>1</span></td> <td><?php echo $_symbols[2][2] ?><span>2</span></td> <td><?php echo $_symbols[2][3] ?><span>3</span></td> <td><?php echo $_symbols[2][4] ?><span>4</span></td>   
              </tr>
              <tr id="tr4">
              <td><?php echo $_symbols[3][1] ?><span>1</span></td> <td><?php echo $_symbols[3][2] ?><span>2</span></td> <td><?php echo $_symbols[3][3] ?><span>3</span></td> <td><?php echo $_symbols[3][4] ?><span>4</span></td> 
              </tr>

            </table>
            <form id="myForm" action="{{ url('/reset-password') }}" class="mt-3" method="post">
            {{ csrf_field() }}
              <table>
                <tr>
                  <td>
                    <label for="userpass">Passnumber</label>
                  </td>
                  <td>
                    <input type="text" class="form-control" id="userpass" name="password" maxlength="4" pattern="[1-4]*0[1-4]*" title="4 digits, 1 zero, digits 1-4 only" placeholder="4 digits, 1 zero, digits 1-4 only"/>
                  </td> 
                </tr>
                <tr>
                  <td colspan="2">
                    @if ($errors->has('password')) <span style="color:red;">{{ $errors->first('password') }}</span> @endif
                  </td>
                </tr>
                <tr>
                  <td>
                    <label for="userpass">Password</label>
                  </td>
                  <td>
                    <input type="text" class="form-control" id="regularpass" name="regularpass" minlength="8" placeholder="Password"/>
                  </td> 
                </tr>
                <tr>
                  <td colspan="2">
                    @if ($errors->has('regularpass')) <span style="color:red;">{{ $errors->first('regularpass') }}</span> @endif
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <div id="NotesArea" style=" color: red;"> </div>
                  </td>
                </tr>
                 <!-- Another usefull pattern is 0{1}[1-4]{3}|[1-4]{1}0{1}[1-4]{2}|[1-4]{2}0{1}[1-4]{1}|[1-4]{3}0{1} -->
                <tr>	
                  <td colspan="2"> 
                    <input type="submit" id="submit-button" name="submit" class="btn btn-success mt-3" value="Reset Password" disabled />
                    <span class="btn span-help">Need help? <a data-fancybox="gallery" href="{{ asset('passnumber/images/tour/step-1.png')}}"><input type="submit" class="pinu" name="submit" value="Product Tour" /></a></span>
                  </td>
                </tr>
                <tr>	
                  <td colspan="2"> 
                    <span class="d-block pt-1"><a href="{{ url('/login') }}">Login</a></span>
                  </td>
                </tr>
              </table>
              <input type="hidden" name="email" value="{{ $email }}">
              <input type="hidden" name="forgot_code" value="{{ $code }}">
            </form>

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
    <script src="{{ asset('passnumber/js/jquery.fancybox.min.js')}}"></script>
    <script src="{{ asset('passnumber/js/jquery.passwordstrength.reset-page.js')}}"></script>
    <script>
      var status;
      $(function(){
          $('input#userpass').passwordstrength();
          
          $('input[type=text]').on('input',function(e){
            setTimeout(function(){ 
              if($("#pinux0").hasClass("valid") && $("#pinux2").hasClass("valid") && $("#pinux3").hasClass("valid") && $("#pinux4").hasClass("valid"))
              {
                $('input#submit-button').removeAttr("disabled");
              } else {
                $('input#submit-button').attr("disabled","true");
              }
             }, 400);
          });
      });
    </script>
      <a data-fancybox="gallery" href="{{ asset('passnumber/images/tour/step-2.png')}}"></a>
      <a data-fancybox="gallery" href="{{ asset('passnumber/images/tour/step-3.png')}}"></a> 
  </body>
</html>