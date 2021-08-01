<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/List.css') }}">
    </head>
    <body class="antialiased">
      <script type="text/javascript" src="{{URL::asset('js/HomePageSortBy.js') }}"></script>
        @extends('Templates.master')
        @section('title')
        View Profile
        @endsection

        @if(count($errors) > 0)

        <div id="searchError">
         @foreach( $errors->all() as $message )
          <div class="alert alert-danger display-hide">
           <button class="close" data-close="alert"></button>
           <span>{{ $message }}</span>
          </div>
         @endforeach
       </div>
        @endif


<div class="highest_div">

  <div class="card mb-3 Card_Holder" >
    <h5 class="card-title">{{$user->UserName}}'s Information</h5>

          <div class = "left_side_user">
            <p class="card-text-Description">
              <Strong> User Name : </strong> {{$user->UserName}}<br>
              <Strong> Full Name : </strong> {{$user->FullName}}<br>
              <Strong> Email : </strong> {{$user->Email}}<br>
              <Strong> Phone Number : </strong> {{$user->PhoneNumber}}<br>
              <Strong> Account Created : </strong> {{\Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i')}}<br>

          </div>
  </div>
          @foreach($events as $event)
          @php
          $imageFound = false
          @endphp
            <div class="card mb-3 Card_Holder" >
                <div class="row g-0 sub_div">
                    @foreach($images as $image)
                      @if($image->EventID == $event->EventID)
                      <div class="col-md-4 sub_div" id="image_holder">
                        <a href="/Event/{{$event->EventID}}"> <img
                          src="{{$image->PictureURL}}"
                          alt="..."
                          class="img-fluid"
                        /></a>
                      </div>
                      @php
                      $imageFound=true
                      @endphp
                      @endif
                    @endforeach


                    @if(!$imageFound)
                  <div class="col-md-4 sub_div" id="image_holder">
                    <a href="/Event/{{$event->EventID}}"> <img
                      src="https://mdbootstrap.com/wp-content/uploads/2020/06/vertical.jpg"
                      alt="..."
                      class="img-fluid"
                    /></a>
                  </div>

                  @endif

                    <div class="col-md-8 sub_div">
                        <div class="card-body sub_div">
                            <h5 class="card-title">{{$event->EventName}} - {{ \Carbon\Carbon::parse($event->Date_Time)->format('d/m/Y H:i')}} <button onclick="window.location.href='/EditEvent/{{$event->EventID}}'" class="edit_button" >Edit</button>   <button onclick="window.location.href='/DeleteEvent/{{$event->EventID}}'" class="edit_button" >Delete</button> </h5>
                            <p class="card-text-Description">
                              <strong>Category : </strong>{{$event->Category}}<br>
                              {{Str::limit($event->Description,80, $end='...')}}
                            </p>
                            <p class="card-text-Creation">
                              <small class="text-muted">Created By: {{$event->UserName}} </small>


                               <a href = "/Interest/{{$event->EventID}}" <button type="Submit"  class="btn btn-outline-danger" id = "likebtn"><i class="bi-heart"></i>{{$event->Interest_Ranking}} Interested </button></a>
                            </p>

                      </div>
                    </div>
                </div>
            </div>


    @endforeach
  </div>
    </body>
</html>
