<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
      img.output_image.img-fluid.mt-2 {
          height: 150px;
          width: 150px;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
            <a class="nav-link font-weight-bold" href="{{ url('/panel/superadmin/logout') }}">Logout</a>
        </li>
        </ul>
    </div>
    </nav>
    <div class="container">
        <div class="row mb-3 mt-3">
            <div class="col-md-12">
                <h2 class="text-info">Add Images in every row</h2>
                <div class="form-group">
                  <label for="row_switcher">Select Row</label>
                  <select name="row_switcher" id="row_switcher" class="form-control">
                    <option value="-">Select a row</option>
                    <option value="1">Row 1</option>
                    <option value="2">Row 2</option>
                    <option value="3">Row 3</option>
                    <option value="4">Row 4</option>
                    <option value="5">Row 5</option>
                    <option value="6">Row 6</option>
                    <option value="7">Row 7</option>
                    <option value="8">Row 8</option>
                    <option value="9">Row 9</option>
                  </select>
                </div>

                <form action="{{ url('/panel/superadmin/upload') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row" id="pass_icons_holder">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type='text/javascript'>
      
// https://stackoverflow.com/questions/4459379/preview-an-image-before-it-is-uploaded

    var textjoiner = '';
      $( "#row_switcher" ).change(function() {
        var row_id = $(this).val();
        $('#pass_icons_holder').load('/panel/superadmin/row/'+row_id);


        /*
        $('#pass_icons_holder').empty();
        textjoiner = '';
        var row_id = $(this).val();
        $.ajax({url: "/panel/superadmin/row/"+row_id, success: function(result){
          console.log(result);
          var serverResponse = result.pass_icons.split("|");

          for (var item in serverResponse) {
              // console.log(serverResponse[item])

              textjoiner += `<div class="col-md-3 mb-2">`;
              textjoiner += `<input type="file" class="imgInp" name="row_one[]" accept="image/*" value="`+serverResponse[item]+`">
                <img class="output_image img-fluid mt-2" src="{{ asset('/pinuimage') }}/`+serverResponse[item]+`"/>
                <input type="hidden" class="input_value" name="pi_one[]" value="`+serverResponse[item]+`">
              </div>`;
          }

          $('#pass_icons_holder').html(textjoiner);

        }});
        */
      });
</script>
  </body>
</html>