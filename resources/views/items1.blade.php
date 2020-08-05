@extends('layouts.master')

@push('css')
    <link rel="stylesheet" href="{{asset('css/items.css')}}">

@endpush

{{--@section('banner')--}}
{{--    @include('banner',[--}}
{{--        'slide1'=>url('/storage/avatars/default.png'),--}}
{{--        'slide2'=>url('/storage/avatars/default.png'),--}}
{{--        'slide3'=>url('/storage/avatars/default.png')--}}
{{--    ])--}}
{{--@endsection--}}


@section('content')

    <!-- Modal -->
    <div id="id01" class="modal" >
        <form class="modal-content animate" action="{{url('/items')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="imgcontainer">
                <span class="close " title="Close Modal">&times;</span>

                <img id="blah" src="{{url('/storage/items/default.png')}}" alt="item image" />
                <div class="update-photo">
                    <input
                        type="file"
                        name="image"
                        id="file"
                        class="inputfile"
                        onchange="readURL(this);"
                    />
                    <label for="file">select photo</label>
                </div>
            </div>

            <div class="container">
                <label for="Title"><b>Title</b></label>
                <input
                    type="text"
                    placeholder="Enter the title"
                    name="title"
                    required
                />

                <label for="phone"><b>Phone</b></label>
                <input
                    type="number"
                    placeholder="Enter your phone number"
                    name="phone"
                    required
                />

                <label for="email"><b>facebook</b></label>
                <input
                    type="text"
                    placeholder="Enter your facebook profile url"
                    name="facebook"
                    required
                />

                <label for="price"><b>Price</b></label>
                <input
                    type="number"
                    placeholder="Enter the price"
                    name="price"
                    required
                />

                <label for="desc"><b>Description</b></label>
                <textarea name="Description" rows="4" cols="50" required> </textarea>

                <button type="submit">save</button>
            </div>
        </form>
    </div>


    <!--start items-->
<section id="container">
    <div id="add-btn">
        <button id="add">
            Add Item
        </button>
    </div>
    <div id="itemscont">
@foreach($items as $item)
            <div class="items">
                <div
                    class="imgcont"
                    style="background-image: url({{url('/storage/items/'.$item->image)}});"
                ><a href="{{url('/items/'.$item->id)}}"></a></div>
                <div class="i-infos">
                    <p class="title" title="{{$item->title}}">{{$item->title}}</p>
                    <p class="price">{{$item->price>0?$item->price.' LE':"Free"}}</p>
                </div>
            </div>
@endforeach
    </div>
</section>
{{$items->links('vendor.pagination.default')}}

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

