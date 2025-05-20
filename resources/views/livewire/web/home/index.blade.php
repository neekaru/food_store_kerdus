@section('title')
Food Store - Eat Your Favorite Foods
@stop

@section('keywords')
Food Store, Eat Your Favorite Foods
@stop

@section('description')
Food Store - Eat Your Favorite Foods
@stop

@section('image')
{{ asset('images/logo.png') }}
@stop

<div>
    <div class="container" style="margin-bottom: 120px">
        
        <!-- Search Bar -->
        <x-utils.search-bar />

        <!-- Sliders -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div id="carouselExample" class="carousel slide w-100">
                    <div class="carousel-inner">
        
                        @foreach ($sliders as $key => $slider)
                            <div class="carousel-item @if($key == 0) active @endif">
                                <img src="{{ asset('/storage/' . $slider->image) }}" class="d-block w-100 rounded">
                            </div>
                        @endforeach
        
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Categories -->

        <!-- Products Popular -->

        <!-- Products Latest -->

    </div>
</div>