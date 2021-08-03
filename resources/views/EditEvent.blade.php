<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="{{ asset('css/Registration.css') }}">


<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


</head>
<body>
    @extends('Templates.master')
        @section('title')
        Register
        @endsection

        @if (Auth::check())
<script type="text/javascript" src="{{URL::asset('js/EventCreation.js') }}"></script>

@if(count($errors) > 0)
<div id="RegisterError">
 @foreach( $errors->all() as $message )
  <div class="alert alert-danger display-hide">
   <button class="close" data-close="alert"></button>
   <span>{{ $message }}</span>
  </div>
 @endforeach
</div>
@endif

<main class="my-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Edit Existing Event</div>
                        <div class="card-body">
                            <form name="my-form" action="/EditEvent/{{$event->EventID}}" method="post" enctype="multipart/form-data">
                            @CSRF
                            <!--- UserName -->
                            <div class="form-group row">
                                    <label for="EventName" class="col-md-4 col-form-label text-md-right">Event Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="EventName" class="form-control" name="EventName" value="{{$event->EventName}}">
                                    </div>
                                </div>

                            <!--- UserName -->
                            <div class="form-group row" id="catRow">
                                <label for="Category" class="col-md-4 col-form-label text-md-right">Category</label>
                                  <div class="col-md-6">
                                      <select   id="Category" class="form-control" name="Category" value="{{$event->Category}}">
                                        <option value = "Sports">Sports</option>
                                        <option value = "Culture">Culture</option>
                                        <option value = "Other">Other</option>
                                      </select>
                                  </div>
                            </div>


                                <!--- Full Name -->
                            <div class="form-group row">
                                    <label for="Date_Time" class="col-md-4 col-form-label text-md-right">Date & Time</label>
                                    <div class="col-md-6">
                                        <input type="datetime-local" id="Date_Time" class="form-control" name="Date_Time" value="{{\Carbon\Carbon::parse($event->Date_Time)->format('Y-m-d\TH:i')}}">
                                    </div>
                                </div>

                                <!--- Email Address -->
                                <div class="form-group row">
                                    <label for="Description" class="col-md-4 col-form-label text-md-right">Description</label>
                                    <div class="col-md-6">
                                        <input type="text" id="Description" class="form-control" name="Description" value="{{$event->Description}}">
                                    </div>
                                </div>


                                <!--- Phone Number -->
                                <div class="form-group row">
                                    <label for="Location" class="col-md-4 col-form-label text-md-right">Location</label>
                                    <div class="col-md-6">
                                        <input type="text" id="Location" name = "Location" class="form-control" value="{{$event->Location}}">
                                    </div>
                                </div>

                                @isset($images)

                                @foreach($images as $image)
                                <div class="form-group row">
                                    <label for="Location" class="col-md-4 col-form-label text-md-right">Image</label>
                                    <div class="col-md-6">
                                        <input type="text" name = "images" class="form-control" value="{{$image}}">
                                    </div>
                                    <a href="{{URL::route('deleteImageFromEvent', [$event->EventID, $image] )}}" class="btn btn-xs btn-info pull-right" >Delete</a>
                                </div>

                                @endforeach

                                @endisset


                                <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                    <input id="upload" type="file" onchange="readURL(this);" name="images[]" multiple class="form-control border-0" accept="image/*">
                                    <label id="upload-label" for="upload" class="font-weight-light text-muted">Upload New Image</label>
                                    <div class="input-group-append">
                                        <label id="upload_new" for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                                    </div>
                                </div>


                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" id="submitBtn">
                                        Update Event
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</main>

            @else
            <?php
            header('Location: /');
            exit;
            ?>
          @endif

</body>
</html>
