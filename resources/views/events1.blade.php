@extends('layouts.master')
@push('css')
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="{{asset('css/events.css')}}" />
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
           <form class="modal-content animate" action="{{url('/events')}}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="imgcontainer">
                   <span class="close " title="Close Modal">&times;</span>

                   <img id="blah" src="{{url('/storage/events/default.png')}}" alt="event image" />
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

                   <label for="location"><b>location</b></label>
                   <input
                       type="text"
                       placeholder="Enter event location"
                       name="location"
                       required
                   />

                   <label for="date"><b>date</b></label>
                   <input
                       type="datetime-local"
                       placeholder="Enter your facebook profile url"
                       name="date"
                       required
                   />

                   <label for="about"><b>about</b></label>
                   <input
                       type="text"
                       placeholder="who are you?"
                       name="about"
                       required
                   />

                   <label for="desc"><b>Description</b></label>
                   <textarea name="description" rows="4" cols="50" required> </textarea>

                   <button type="submit">save</button>
               </div>
           </form>
       </div>

       <section class="sec2">
        <div id="add-btn">
            <button id="add">
                Add Service
            </button>
        </div>

        @foreach($events as $event)
      <div id="events">
        <div class="right-sec">

            <div class="in-star">
              <i class="fas fa-star" aria-hidden="true" onclick="interest({{$event->id}})"></i>
            </div>

          <p>{{$event->interests}}</p>
          <p>interests</p>
        </div>
        <div class="left-sec">
            <a href="{{{url('/events/'.$event->id)}}}">
                <div
            style="
              background: linear-gradient(
                  to right,
                  rgba(255, 255, 255, 0),
                  #00363d9d 70%
                ),
                url({{url('/storage/events/'.$event->image)}});
              background-repeat: no-repeat;
              background-size: cover;
            "
            class="events-bg"
          ></div>
            </a>
        </div>
      </div>
    @endforeach
        {{$events->links('vendor.pagination.default')}}
    </section>
    <script >
        function interest(eventId) {
            axios.post('/events/' + eventId + '/interest');
        }
    </script>
    @endsection
@section('footer')

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
