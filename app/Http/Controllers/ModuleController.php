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
use Illuminate\Support\Facades\File;

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
            'UserName' => ['required', 'string', 'max:50', 'min:3' ,'unique:organiser_information', 'alpha_dash'],
            'Password' => ['required', 'min:6', 'max:50', 'alpha_dash'],
            'FullName' => ['required','max:70'],
            'Email' => ['required','email','max:70'],
            'PhoneNumber' => ['required','regex:/^(\+44\s?\d{10}|0044\s?\d{10}|0\s?\d{10})?$/','numeric'],

        ]);
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
    $errors = "";
    $request->validate([
            'EventName' => ['required','min:3','max:70'],
            'Category' => 'required',
            'Date_Time' => 'required',
            'Description' => ['required','min:3','max:255'],
            'Location' => ['required','min:1','max:255'],

        ]);

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
        if($request['images']!=null){
        $this->storeImages($request);
        }

        return redirect("/")->withSuccess('You have Created an Event');
    }


    public function storeImages(Request $request){
      //removes the first occurence in array which is FileName:
     $images = $request->file('images');

      $request->validate([
                'images' => 'required',
                'images.*' => 'mimes:jpeg,bmp,png,jpg' // Only allow .jpg, .bmp and .png file types.
            ]);

            foreach($images as $file){
              // Save the file locally in the storage/public/ folder under a new folder named /product
              $path = $file->storeAs('public/images', $request['EventID'].$file->getClientOriginalName());

              // Store the record, using the new file hashname which will be it's new filename identity.
              $eventImages = new EventImages([
                  "EventID" => $request['EventID'],
                  "PictureURL" => 'storage'.str_replace("public", "", $path)
              ]);
              $eventImages->save(); // Finally, save the record.
            }

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
        $errors = "Failed to register your interest! Please try again!";
        return redirect("/")->withErrors($errors);
    }
    }


    public function eventPage(Request $request){
    try{
    $event = Module::where('EventID',$request['EventID'])->firstOrFail();
    if($event === null){
      $errors = "Event does not exist";
      return redirect("/")->withErrors($errors);
    }
    $images= EventImages::where('EventID',$request['EventID']);
    $getUserNameRequest = Module::select('UserName')->whereRaw('EventID', $request['EventID'])->get();
    $getUserName;
    foreach ($getUserNameRequest as $userNameFromRequest) {
      $getUserName=$userNameFromRequest->UserName;
    }
    $eventOwner = User::select('FullName','Email','PhoneNumber')->where('UserName',$getUserName )->firstOrFail();
      echo "<script>console.log('Debug Objects: " .$getUserName . "' );</script>";

    if($images !== null){
    $imageCollection=array();
     foreach($images->get() as $image){
     array_push($imageCollection,$image);
       echo "<script>console.log('Debug Objects: " . $image . "' );</script>";
     }
     return view('/Event', compact('event','imageCollection','eventOwner'));
    }
    else{
        return view('/Event')->with(['event'=>$event],['images'=>'https://i.stack.imgur.com/y9DpT.jpg']);
    }
    }
    catch(Exception $e){
        return redirect("/")->with('requestError','Invalid Event');
    }


    }



    public function EditEventGet($EventID){
      $event = Module::where('EventID',$EventID)->firstOrFail();
      $images = $this->getImageNamesForEvent($EventID);
      if($images === null){
      return view('/EditEvent')->with(['event'=>$event]);
      }
      else{
        return view('/EditEvent',compact('event','images'));
      }
    }

    public function EditEventPost($EventID, Request $request){
      $errors = "";
      $validateResult = $request->validate([
              'EventName' => ['required','min:3','max:70'],
              'Category' => 'required',
              'Date_Time' => 'required',
              'Description' => ['required','min:3','max:255'],
              'Location' => ['required','min:1','max:255'],

          ]);



      $event = Module::where('EventID',$EventID)->firstOrFail();

      $event->EventName = $request['EventName'];
      $event->Category = $request['Category'];
      $event->Date_Time = $request['Date_Time'];
      $event->Description = $request['Description'];
      $event->Location = $request['Location'];

      $event->save();

      $request->EventID = $EventID;

      if($request->hasfile('images')){
        $this->storeImages($request);
      }

      return redirect()->route('EditEventGet',$EventID);
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
      $images = EventImages::where('EventID',$EventID)->get();
      if($images!==null){
        foreach($images as $image){
          $imageName = str_replace("storage/images/".$EventID,"",$image->PictureURL);
          $image->delete();
          File::delete("storage/images/".$EventID.$imageName);
        }
      }
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

    public function getImageNamesForEvent($EventID){
      $imagesRaw = EventImages::where('EventID',$EventID)->get();
      if($imagesRaw ===null){
        return null;
      }
      $images = array();
      foreach($imagesRaw as $image){
        $imageName = str_replace("storage/images/".$EventID,"",$image->PictureURL);
        array_push($images,$imageName);
      }
      return $images;
    }
    public function deleteImageFromEvent($EventID,$Image){
    try{  $pathToDelete =  "storage/images/".$EventID.$Image;
      EventImages::where('PictureURL',$pathToDelete)->delete();
      File::delete("storage/images/".$EventID.$Image);
          return redirect()->route('EditEventGet',$EventID);
        }
      catch(Exception $e){
       $errors = "Could not delete image!";
        return redirect()->route('EditEventGet',$EventID)->withErrors($errors);
      }
    }


}
