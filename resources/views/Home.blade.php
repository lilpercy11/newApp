<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/List.css') }}">
    </head>
    <body class="antialiased">
      <script type="text/javascript" src="{{URL::asset('js/HomePageSortBy.js') }}"></script>
        @extends('Templates.master')
        @section('title')
        Home
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

        @if(!Route::current()->getName() == 'Search')


        <div class="container" id="filterDiv">
        	<div class="btn-group sort-btn">
        		<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id = "sortByBtn">

              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
              <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
              </svg>
              Sort By

            </button>

        		<ul class="dropdown-menu">
        			<li><a href="/Filter/EventName" tabindex="-1" data-type="alpha">Name</a></li>
        			<li><a href="/Filter/Date_Time" tabindex="-1" data-type="numeric">Date & Time</a></li>
              <li><a href="/Filter/Interest_Ranking" tabindex="-1" data-type="numeric">Interest Rating</a></li>
              <li><a href="/Filter/Category" tabindex="-1" data-type="alpha">Category</a></li>
        		</ul>
        	</div>
        </div>
        @endif



<!--
<button class="btn btn-primary dropdown-toggle" data-sort="none"><i class="fa fa-sort" id="sortButton"></i></button><!-- .dropdown-toggle adds rounded borders and reduces padding. It does not trigger dropdowns.
        <div class="dropdown" id="filterDiv">
          <a class="btn btn-secondary dropdown-toggle"  role="button" id="dropdownMenuFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
            <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
            </svg>
            Filter
          </a>

          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="/Filter/FullName">Name</a>
            <a class="dropdown-item" href="/Filter/Date_Time">Date</a>
            <a class="dropdown-item" href"/Filter/Interest_Ranking">Interest</a>
          </div>
        </div>


        <div class="dropdown" id="filterDiv">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
    <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
    </svg>
    Filter
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
    <button class="dropdown-item" type="button" id="Filter_Name" href = "/Filter/Name">Name</button>
    <button class="dropdown-item" type="button" id="Filter_Date" href = "/Filter/Date">Date</button>
    <button class="dropdown-item" type="button" id="Filter_Interest" href = "/Filter/Interest">Interest</button>
  </div>
</div> -->

          @foreach($events as $event)
          @php
          $imageFound = false
          @endphp
            <div class="card mb-3" id="Card_Holder">
                <div class="row g-0">
                    @foreach($images as $image)
                      @if($image->EventID == $event->EventID)
                      <div class="col-md-4" id="image_holder">
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
                  <div class="col-md-4" id="image_holder">
                    <a href="/Event/{{$event->EventID}}"> <img
                      src="https://mdbootstrap.com/wp-content/uploads/2020/06/vertical.jpg"
                      alt="..."
                      class="img-fluid"
                    /></a>
                  </div>

                  @endif

                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{$event->EventName}} - {{ \Carbon\Carbon::parse($event->Date_Time)->format('d/m/Y H:i')}}</h5>
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

    </body>
</html>
