@extends('layouts/main')
@section('content')

<ul>
    <div class="columns is-multiline"> {{-- Start of columns --}}
        @foreach($recipes as $recipe)
            <div class="column is-4 mb-5">
              <span><small class="has-text-grey-dark">10 jun 2021 19:40</small></span>
              <a href="{{ url('recipes/' . $recipe->slug) }}">
              <h2 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">{{ $recipe->title }}</h2></a>
              <p class="subtitle has-text-grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque massa nibh, pulvinar vitae aliquet nec, accumsan aliquet orci.</p>
              <a href="#">Read More</a>
            </div>
        @endforeach
    </div> {{-- End of columns --}}
</ul>

 
        
  @endsection