<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\EventImages;
use App\Models\User;
use Validator;
use Auth;
use Crypt;
use Illuminate\Support\Facades\Hash;

class ModuleController extends Controller
{
    public function list(){
      $events = Module::all();
      $images = $this->getImagesHome($events);

		return view('/Home', compact('events','images'));
	}

public function getImagesHome($events){
  //small function to create images as to prevent data duplication
  $images = array();
  foreach ($events as $event) {
    $image = EventImages::where('EventID',$event->EventID)->first();
    if($image != null){
     array_push($images, $image);
     //echo "<script type='text/javascript'>alert(". $image .");</script>";
   }
  }
  return $images;
}

public function filterEvents($filterBy){
  if($filterBy === "Interest_Ranking"){
  $events = Module::all()->sortByDesc($filterBy);
}
  else{
      $events = Module::all()->sortBy($filterBy);
  }
  $images = $this->getImagesHome($events);
  return view('/Home', compact('events','images'));
}

public function searchEvents(Request $request){
  $events = Module::where('EventName','LIKE',$request['Search'].'%' )->get();
  $images = $this->getImagesHome($events);
  if(count($events)>0){
  return view('/Home', compact('events','images'));
  }
  else{
    $errors = 'No Events Match Your Search, Please Try Again!';
    echo "<script type='text/javascript'>alert('No Events Match Your Search, Please Try Again!');</script>";

    return redirect('/')->withErrors($errors);
  }
}

    public function create()
    {
        return view('Register');
    }

     public function storeNewUser(Request $request)
    {

       $request->validate([
            'UserName' => 'required',
            'Password' => ['required', 'min:6'],
            'FullName' => 'required',
            'Email' => 'required|email',
            'PhoneNumber' => ['required','regex:/^(\+44\s?\d{10}|0044\s?\d{10}|0\s?\d{10})?$/'],

        ]);
        $ExistingUser = User::where('UserName', $request['UserName'])->first();
        if($ExistingUser === null){
        $user= new User();
        $user->UserName= $request['UserName'];
        $user->Password= $request['Password'];
        $user->FullName= $request['FullName'];
        $user->Email= $request['Email'];
        $user->PhoneNumber= $request['PhoneNumber'];


       $user = User::create($request->all());
       Auth::login($user,true);
       return redirect("/")->withSuccess('You have signed-in');
     }
      else{
        $errors = "Username already exists";
        return redirect()->back()->withErrors($errors);
      }

    }

    public function login(Request $request){
      if(!Auth::check()){
        $request->validate([
            'UserName' => 'required',
            'Password' => 'required',
        ]);
        $errors = 'Login details are not correct!';

       $user = User::where('UserName',$request['UserName'])->first();
            if ($user && Hash::check($request['Password'], $user->Password)) {
             //success
             //echo "<script>console.log('Debug Objects: " . $request['UserName'] . "' );</script>";
               // echo "<script>console.log('Debug Objects: " . $request['Password'] . "' );</script>";

               Auth::login($user,true);
                if(Auth::check()){
                   // echo "<script>console.log('Debug Objects: " . "Success" . "' );</script>";
                    return redirect("/")->withSuccess('You have signed-in');
                }
                else{
                   // echo "<script>console.log('Debug Objects: " . "Failed Auth" . "' );</script>";
                    return redirect()->back()->withErrors($errors);
                }



             }
             else{
                return redirect()->back()->withErrors($errors);
             }
       //  }
     }
     else{
       return redirect()->back()->withErrors("You are already Logged In! Please Sign Out First");
     }
    }

    public function logout(){
        Auth::logout();
            return redirect("/")->withSuccess('Logged Out');
        }




    public function createEvent(Request $request){
    echo "<script type='text/javascript'>alert('event');</script>";
    echo "<script>console.log('Debug Objects: " . 'Creating event' . "' );</script>";
   // $request->validate([
    //        'UserName' => 'required',
    //        'EventName' => 'required',
    //        'Category' => 'required',
    //        'Date_Time' => 'required',
     //       'Description' => 'required',
      //      'Location' => 'required',

//        ]);

        $event = new Module();
        $event->UserName = Auth::user()->UserName;
        $event->EventID = mt_rand(1000000000, 9999999999);
        $event->EventName = $request['EventName'];
        $event->Category = $request['Category'];
        $event->Date_Time = $request['Date_Time'];
        $event-> Description = $request['Description'];
        $event->Location = $request['Location'];
        $event->Interest_Ranking = 0;

        $request->request->add(['EventID' => mt_rand(1000000000, 9999999999)]);
        $request->request->add(['UserName' => Auth::user()->UserName]);
        $request->request->add(['Interest_Ranking' => 0]);

        $event = Module::create($request->all());

//This section is for calling the imgur api to create a URL to store in the Database - not working
//$client_id = 'd8a4be1553876b4';
  /*      $client = new http\Client;
        $requestAPI = new http\Client\Request;
        $requestAPI->setRequestUrl('https://api.imgur.com/3/upload');
        $requestAPI->setRequestMethod('POST');
        $body = new http\Message\Body;
        $body->addForm(array(

        ), array(
        array('name' => 'image', 'type' => '<Content-type header>', 'file' => $request['upload'], 'data' => null)
        ));
        $requestAPI->setBody($body);
        $requestAPI->setOptions(array());
        $requestAPI->setHeaders(array(
        'Authorization' => 'Client-ID 546c25a59c58ad7'
        ));
        $client->enqueue($requestAPI)->send();
        $response = $client->getResponse();
        echo $response->getBody();
        echo "<script>console.log('Debug Objects: " . $response->getBody() . "' );</script>";
*/

        return redirect("/")->withSuccess('You have Created an Event');
    }

    public function interest(Request $request){
    echo "<script type='text/javascript'>alert('interest');</script>";
    echo "<script>console.log('Debug Objects: " . 'Interest Called' . "' );</script>";
    try{
        $event = Module::where('EventID',$request['EventID'])->firstOrFail();
        $previousValue =  $event->Interest_Ranking ;
        $event->Interest_Ranking++;
        $event->save();
        echo "<script type='text/javascript'>alert('Succesfully updated value');</script>";
        return redirect("/")->withSuccess('You have registered an interest in an event');;
    }
    catch(Exception $e){
        echo "<script type='text/javascript'>alert('Failed to update value');</script>";
        report($e);
        return;
    }
    }


    public function eventPage(Request $request){
    try{
    $event = Module::where('EventID',$request['EventID'])->firstOrFail();
    $images= EventImages::where('EventID',$request['EventID']);
    $getUserNameRequest = Module::select('UserName')->where('EventID', $request['EventID'])->get();
    $getUserName;
    foreach ($getUserNameRequest as $userNameFromRequest) {
      $getUserName=$userNameFromRequest->UserName;
    }
    $eventOwner = User::select('FullName','Email','PhoneNumber')->where('UserName',$getUserName )->firstOrFail();
  //  echo "<script>console.log('Debug Objects: " .$debuging . "' );</script>";
      echo "<script>console.log('Debug Objects: " .$getUserName . "' );</script>";
    // $eventOwnerRequest= User::select('FullName','Email','PhoneNumber')->where('UserName', Module::select('UserName')->where('EventID', $request['EventID'])->get())->get();
  //  $eventOwner=array();
    //if($eventOwnerRequest !==null){
  //    foreach ($eventOwnerRequest as $eventOwnerPlaceHolder) {
  //      echo "<script>console.log('Debug Objects: " .$eventOwnerPlaceHolder . "' );</script>";
  //      array_push($eventOwner,$eventOwnerPlaceHolder);
  //    }
  //    echo "<script type='text/javascript'>alert('Event Owner Populated');</script>";
  //  }
  //  else{
  //    echo "<script type='text/javascript'>alert('event owner null');</script>";
//    }
    if($images !== null){
    $imageCollection=array();
     //echo "<script type='text/javascript'>alert('Success image');</script>";
     foreach($images->get() as $image){
     array_push($imageCollection,$image);
     //echo "<script type='text/javascript'>alert('Success image 2');</script>";
       echo "<script>console.log('Debug Objects: " . $image . "' );</script>";
       // echo "<script type='text/javascript'>alert(".$images.");</script>";
     }
   //  echo "<script type='text/javascript'>alert(".$images->get().");</script>";
     //return view('/Event')->with(['event'=>$event],['images'=>$imageCollection]);
     return view('/Event', compact('event','imageCollection','eventOwner'));
    }
    else{
        return view('/Event')->with(['event'=>$event],['images'=>'https://i.stack.imgur.com/y9DpT.jpg']);
    }
     //echo "<script>console.log('Debug Objects: " . $images . "' );</script>";
   // echo "<script type='text/javascript'>alert('Success valid Event');</script>";
    //echo "<script type='text/javascript'>alert(".$event.");</script>";

   // return view('/Event', compact('event','images'));
    }
    catch(Exception $e){
        //echo "<script type='text/javascript'>alert('Invalid Event');</script>";
        return redirect("/")->with('requestError','Invalid Event');
    }


    }



    public function EditEventGet($EventID){
      $event = Module::where('EventID',$EventID)->firstOrFail();
      return view('/EditEvent')->with(['event'=>$event]);
    }

    public function EditEventPost($EventID, Request $request){
      $event = Module::where('EventID',$EventID)->firstOrFail();

      $event->EventName = $request['EventName'];
      $event->Category = $request['Category'];
      $event->Date_Time = $request['Date_Time'];
      $event->Description = $request['Description'];
      $event->Location = $request['Location'];

      $event->save();

      return view('/EditEvent')->with(['event'=>$event]);
    }

    public function ViewProfile(){
      if(Auth::check()){
        $user = User::where('UserName',Auth::user()->UserName)->firstOrFail();
        $events = Module::where('UserName',$user->UserName)->get();
        $images = $this->getImagesHome($events);
        return view('/ViewProfile', compact('user','events','images'));
      }
      else{
        return redirect ("/Login")->withErrors("Please Log In before attempting to view your profile!");
      }
    }

    public function deleteEvent($EventID){
      $event = Module::where('EventID',$EventID)->firstOrFail();
      if(Auth::check()){
        if(Auth::user()->UserName === $event->UserName){
          $event->delete();
          return redirect()->back();
        }
        else{
          return redirect ("/Login")->withErrors("You are not authorised to delete this event! Please Log In as the event owner!");
        }
      }
      else{
        return redirect ("/Login")->withErrors("Please Log In before deleting an event!");
      }
    }

    public function storeImages(Request $request){
      $request->validate([
                'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->file->store('product', 'public');

            // Store the record, using the new file hashname which will be it's new filename identity.
            $product = new Product([
                "name" => $request->get('name'),
                "file_path" => $request->file->hashName()
            ]);
            $product->save(); // Finally, save the record.
    }
}
