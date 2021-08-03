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
                        <div class="card-header">Create Event</div>
                        <div class="card-body">
                            <form name="my-form" action="{{url('/CreateEvent')}}" method="post" enctype="multipart/form-data">
                            @CSRF
                            <!--- UserName -->
                            <div class="form-group row">
                                    <label for="EventName" class="col-md-4 col-form-label text-md-right">Event Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="EventName" class="form-control" name="EventName">
                                    </div>
                                </div>

                            <!--- UserName -->
                            <div class="form-group row" id="catRow">
                                <label for="Category" class="col-md-4 col-form-label text-md-right">Category</label>
                                  <div class="col-md-6">
                                      <select   id="Category" class="form-control" name="Category" >
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
                                        <input type="datetime-local" id="Date_Time" class="form-control" name="Date_Time">
                                    </div>
                                </div>

                                <!--- Email Address -->
                                <div class="form-group row">
                                    <label for="Description" class="col-md-4 col-form-label text-md-right">Description</label>
                                    <div class="col-md-6">
                                        <input type="text" id="Description" class="form-control" name="Description">
                                    </div>
                                </div>


                                <!--- Phone Number -->
                                <div class="form-group row">
                                    <label for="Location" class="col-md-4 col-form-label text-md-right">Location</label>
                                    <div class="col-md-6">
                                        <input type="text" id="Location" name = "Location" class="form-control">
                                    </div>
                                </div>








                                           <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                               <input id="upload" type="file" onchange="readURL(this);" name="images[]" multiple class="form-control border-0" accept="image/*">
                                               <label id="upload-label" for="upload" class="font-weight-light text-muted">Upload New Image</label>
                                               <div class="input-group-append">
                                                   <label id="upload_new" for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                                               </div>
                                           </div>

<!-- Upload image input
<textarea rows="5" cols="1" id="URLInput" ></textarea>
                                           <div class="form-group row">
                                               <label for="URLInput" class="col-md-4 col-form-label text-md-right">Picture URL's</label>
                                               <input type="file" id="URLInput" name="image1" class="form-control">
                                           </div>
                                         -->





                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" id="submitBtn">
                                        Create Event
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
