<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/EventPage.css') }}">
    </head>
    <body class="antialiased">
        @extends('Templates.master')
        @section('title')
        {{$event->EventName}}
        @endsection



            <div class="card mb-3" id="Card_Holder">
                <div class="row g-0">

                    <div class="col-md-4" id="Image_Holder">

                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">

                        @foreach ($imageCollection as $index=>$image)
                        @if($index==0)
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        @else
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{$index}}"></li>
                        @endif
                        @endforeach
                      </ol>
                  <div class="carousel-inner">
                        @if($imageCollection==null)
                        <div class="carousel-item active">
                         <img class="d-block w-100" src="https://mdbootstrap.com/wp-content/uploads/2020/06/vertical.jpg" alt="First slide">
                        </div>
                        </div>
                        </div>

                  @else
                        @foreach ($imageCollection as $index=>$image)
                            @if($index===0)
                            <div class="carousel-item active">
                            <img class="d-block w-100" src="{{url($image->PictureURL)}}" alt="First slide">
                            </div>
                           @else
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{url($image->PictureURL)}}" alt="Second slide">
                        </div>
                         @endif
                      @endforeach

                      </div>
                          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                    </div>
                    @endif

                    </div>

                    <div class="col-md-8">

                      <div class="col-xs-6 center" id="interestButton">
                        <strong>Category - {{$event->Category}}</strong>
                         <a href = "/Interest/{{$event->EventID}}" <button type="Submit"  class="btn btn-outline-danger"  id = "likebtn"><i class="bi-heart"></i>{{$event->Interest_Ranking}} Interested </button></a>
                      </div>
                        <div class="card-body">

                            <h5 class="card-title">{{$event->EventName}} - {{ \Carbon\Carbon::parse($event->Date_Time)->format('d/m/Y H:i')}}</h5>
                            <p class="card-text-Description">
                              <strong>Location - {{$event->Location}}</strong><br>
                              {{$event->Description}}
                            </p>
                            <p class="card-text-Creation">




                               <br>
                               <small class="text-muted">Contact Info:</small><br>
                               <small class="text-muted">Username: {{$event->UserName}} </small><br>
                               <small class="text-muted">Name: {{$eventOwner->FullName}} </small><br>
                               <small class="text-muted">Email: {{$eventOwner->Email}} </small><br>
                               <small class="text-muted">Phone Number: {{$eventOwner->PhoneNumber}} </small><br>

                            </p>


                      </div>

                    </div>
                </div>
            </div>



    </body>
</html>
