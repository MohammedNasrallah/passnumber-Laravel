@foreach($images as $key=>$image)
  <div class="row mb-2">
  <?php $count=0; ?>
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