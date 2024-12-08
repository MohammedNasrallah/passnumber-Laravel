                          <?php $iconpack = explode("|",$icons); ?>
                          <div class="col-md-12">
                            <h4 class="bg-primary pl-4 pt-3 pb-3 border rounded"><span class="text-white">Row {{ $id }} PassNumber Icons</span></h4>
                          </div>


                         
                          <div class="col-md-3 mb-2">
                              <input type="file" class="imgInp" name="row_one[]" accept="image/*">
                              <img class="output_image img-fluid mt-2" src="{{ asset('/passnumber/images/allicons') }}/{{ @$iconpack[0] }}"/>
                              <input type="hidden" class="input_value" name="pi_one[]" value="{{ @$iconpack[0] }}">
                          </div>
                          <div class="col-md-3 mb-2">
                              <input type="file" class="imgInp" name="row_one[]" accept="image/*">
                              <img class="output_image img-fluid mt-2" src="{{ asset('/passnumber/images/allicons') }}/{{ @$iconpack[1] }}"/>
                              <input type="hidden" class="input_value" name="pi_one[]" value="{{ @$iconpack[1] }}">
                          </div>
                          <div class="col-md-3 mb-2">
                              <input type="file" class="imgInp" name="row_one[]" accept="image/*">
                              <img class="output_image img-fluid mt-2" src="{{ asset('/passnumber/images/allicons') }}/{{ @$iconpack[2] }}"/>
                              <input type="hidden" class="input_value" name="pi_one[]" value="{{ @$iconpack[2] }}">
                          </div>
                          <div class="col-md-3 mb-2">
                              <input type="file" class="imgInp" name="row_one[]" accept="image/*">
                              <img class="output_image img-fluid mt-2" src="{{ asset('/passnumber/images/allicons') }}/{{ @$iconpack[3] }}"/>
                              <input type="hidden" class="input_value" name="pi_one[]" value="{{ @$iconpack[3] }}">
                          </div>
                          <div class="col-md-3 mb-2">
                              <input type="file" class="imgInp" name="row_one[]" accept="image/*">
                              <img class="output_image img-fluid mt-2" src="{{ asset('/passnumber/images/allicons') }}/{{ @$iconpack[4] }}"/>
                              <input type="hidden" class="input_value" name="pi_one[]" value="{{ @$iconpack[4] }}">
                          </div>
                          <div class="col-md-3 mb-2">
                              <input type="file" class="imgInp" name="row_one[]" accept="image/*">
                              <img class="output_image img-fluid mt-2" src="{{ asset('/passnumber/images/allicons') }}/{{ @$iconpack[5] }}"/>
                              <input type="hidden" class="input_value" name="pi_one[]" value="{{ @$iconpack[5] }}">
                          </div>
                          <div class="col-md-3 mb-2">
                              <input type="file" class="imgInp" name="row_one[]" accept="image/*">
                              <img class="output_image img-fluid mt-2" src="{{ asset('/passnumber/images/allicons') }}/{{ @$iconpack[6] }}"/>
                              <input type="hidden" class="input_value" name="pi_one[]" value="{{ @$iconpack[6] }}">
                          </div>
                          <div class="col-md-3 mb-2">
                              <input type="file" class="imgInp" name="row_one[]" accept="image/*">
                              <img class="output_image img-fluid mt-2" src="{{ asset('/passnumber/images/allicons') }}/{{ @$iconpack[7] }}"/>
                              <input type="hidden" class="input_value" name="pi_one[]" value="{{ @$iconpack[7] }}">
                          </div>
                          <div class="col-md-3 mb-2">
                              <input type="file" class="imgInp" name="row_one[]" accept="image/*">
                              <img class="output_image img-fluid mt-2" src="{{ asset('/passnumber/images/allicons') }}/{{ @$iconpack[8] }}"/>
                              <input type="hidden" class="input_value" name="pi_one[]" value="{{ @$iconpack[8] }}">
                          </div>









                          <input type="hidden" name="row_no" value="{{ $id }}">
                          <div class="col-md-12">
                                <input type="submit" value="Upload" class="btn btn-success">
                            </div>

    <script type='text/javascript'>
      // 
      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function(e) {
            $(input).siblings('.output_image').attr('src', e.target.result);
          }
          
          reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
      }

      $(".imgInp").on('change',function() {
        var img_name = $(this).val().replace(/C:\\fakepath\\/i, '');
        $(this).siblings('.input_value').val(img_name);
        readURL(this);
      });
</script>