<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/List.css') }}">
    </head>
    <body class="antialiased">
        @extends('Templates.master')
        @section('title')
        List
        @endsection


        
        
        @foreach($events as $event)
           
            <div class="card mb-3" id="Card_Holder">
                <div class="row g-0">
                    <div class="col-md-4">
                      <img
                        src="https://mdbootstrap.com/wp-content/uploads/2020/06/vertical.jpg"
                        alt="..."
                        class="img-fluid"
                      />
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{$event->EventName}}</h5>
                            <p class="card-text-Description">
                              {{$event->Description}}
                            </p>
                            <p class="card-text-Creation">
                              <small class="text-muted">Created By: {{$event->UserName}} </small>
                              

                               <a href = "/Interest/{{$event->EventID}}" method="post">  <button type="Submit"  class="btn btn-outline-danger" id = "likebtn"><i class="bi-heart"></i>{{$event->Interest_Ranking}} Interested </button></a> 
                            </p>
                       
                      </div>
                    </div>
                </div>
            </div>


    @endforeach
    
    
    <!--
        <table border="5" class = "tableOutput">
            <thead>
                <tr>
                    <th> Event Organiser </th>
                    <th> Event ID </th>
                    <th> Event Name </th>
                    <th> Category </th>
                    <th> Date and Time </th>
                    <th> Creation Date </th>
                    <th> Description </th>
                    <th> Location </th>
                    <th> Interest </th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td> {{$event->UserName}} </td>
                    <td> {{$event->EventID}} </td>
                    <td> {{$event->EventName}} </td>
                    <td> {{$event->Category}} </td>
                    <td> {{$event->Date_Time}} </td>
                    <td> {{$event->CreationDate}} </td>
                    <td> {{$event->Description}} </td>
                    <td> {{$event->Location}} </td>
                    <td> {{$event->Interest_Ranking}} </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        -->
    </body>
</html>
