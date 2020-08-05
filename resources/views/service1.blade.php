@extends('layouts.master')
@push('css')
    <link rel="stylesheet" href="/css/service.css"/>
@endpush
@push('js')
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
@endpush
{{--@section('banner')--}}
{{--@include('banner',[--}}
{{--    'slide1'=>url('/storage/avatars/default.png'),--}}
{{--    'slide2'=>url('/storage/avatars/default.png'),--}}
{{--    'slide3'=>url('/storage/avatars/default.png')--}}
{{--])--}}
{{--    @endsection--}}
@section('content')
    <div id="id01" class="modal">
        <form class="modal-content animate" action="{{url('/services')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="imgcontainer">
                <span class="close" title="Close Modal">&times;</span>
            </div>

            <div class="container">
                <label for="Title"><b>Title</b></label>
                <input
                    type="text"
                    placeholder="Enter the title"
                    name="title"
                    required
                />

                <label for="price"><b>price</b></label>
                <input
                    type="number"
                    placeholder="Enter your price"
                    name="price"
                    required
                />

                <label for="target"><b>target</b></label>
                <input
                    type="text"
                    placeholder="Enter your targeted community"
                    name="target"
                    required
                />

                <label for="goal"><b>goal</b></label>
                <input
                    type="number"
                    placeholder="after how much interests your service will start?"
                    name="goal"
                    required
                />

                <label for="desc"><b>Description</b></label>
                <textarea name="description" rows="4" cols="50" required > </textarea>

                <button type="submit">save</button>
            </div>
        </form>
    </div>

<main>
    <section id="container">
        <div id="add-btn">
            <button id="add">
                Add Service
            </button>
        </div>
        @foreach($services as $service)
        <section id="content">
            <a href="{{url('/services/'.$service->id)}}">
            <div class="top-sec">
                <span class="timer"> <p>
                        @if ($service->created_at->diffInDays() > 30)
                            {{$service->created_at->toFormattedDateString()}}
                        @else
                            {{$service->created_at->diffForHumans()}}
                        @endif
                    </p></span>
                <span class="title"> <p>{{$service->title}}</p></span>
            </div>
            <div class="mid-sec">
                <p>
                   {{$service->description}}
                </p>
                <div class="border"></div>
            </div>
            </a>
            <div class="bot-sec">
                <form action="">
                <button class="interested" onclick="interest({{$service->id}})"><i class="fas fa-star fa-2x"></i>
                        @if($service->is_interested)
                            {{'interested'}}
                            @else
                            {{'interest'}}
                            @endif
                    </button>
                </form>
            </div>
        </section>


        @endforeach

    </section>
    <script >
        function interest(serviceId) {
            event.preventDefault();
            axios.post('/services/' + serviceId + '/interest');
        }
    </script>
    {{$services->links('vendor.pagination.default')}}
</main>
@endsection
@push('js')
    <script>
        // Get the modal
        var modal = document.getElementById("id01");
        // Get the button that opens the modal
        var btn = document.getElementById("add");
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        var img =document.getElementById('blah');
        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "grid";
        };

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        };

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };

        /*** select photo */
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    img.src = e.target.result
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    @endpush
