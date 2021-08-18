<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\Booking;
use App\Models\Accommodation;
use Response;
use DB;

class ApiController extends Controller
{
    // by91sEYA8YAEIa8-ShiQCQ


    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function addRooms()
    {
        try{

            $url = "https://api.proxycrawl.com/scraper?token=hu0wGfmSmlvQ3tvIgGN0QQ&url=https://www.airbnb.com/s/Beirut/homes";

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $resp = curl_exec($curl);
            curl_close($curl);
            $data=json_decode($resp);    

            if($data->original_status == 200 && $data->pc_status == 200 )
            {
                    $res_val=[];
                    $residents_data=$data->body->residents;

                        for($i=0; $i<sizeof($residents_data);$i++)  {
                        
                            $res_val= Resident::create([
                                    'title'=>$residents_data[$i]->title,
                                    'superHost'=>$residents_data[$i]->superHost,
                                    'residentType'=>$residents_data[$i]->residentType,
                                    'location'=>$residents_data[$i]->location,
                                    'samplePhotoUrl'=>$residents_data[$i]->samplePhotoUrl,
                                    'rating'=>$residents_data[$i]->rating,
                                    'personReviewed'=>$residents_data[$i]->personReviewed,
                                ]);

                                $accommodation =$residents_data[$i]->accommodation;

                                $acc_val=Accommodation::create([
                                    'res_id'=>$res_val->id,
                                    'guests'=>$accommodation->guests,
                                    'bedrooms'=>$accommodation->bedrooms,
                                    'beds'=>$accommodation->beds,
                                    'baths'=>$accommodation->baths,
                                ]);
                        }
                }
               
          
           return response()->json(['data'=>[],'status'=>'success','statuscode'=>'200']);

        }catch(\Exception $e){

                return response()->json(['data'=>[],'status'=>'failed','statuscode'=>'500']);
            } 
    } 
    
    public function bookRooms(Request $request){

    try{
        $validated = $request->validate([
            'user_email' => 'required',
            'room_id' => 'required',
            'no_days' => 'required',
            'time' => 'required',
        ]);

        $booking = Booking::create([

            'user_email'=>$validated['user_email'],
            'room_id'=>$validated['room_id'],
            'no_days'=>$validated['no_days'],
            'time'=>$validated['time'],
        ]);

        Resident::where('id',$validated['room_id'])->update([
            'book_id'=>$booking->id,
        ]);


        return response()->json(['data'=>$booking,'status'=>'success','statuscode'=>'200']);

    }catch(\Exception $e){

            return response()->json(['data'=>[],'status'=>'failed','statuscode'=>'500']);
        } 

    }

    public function getRooms(){
      
        try{

            $top_rooms=DB::table('residents')
            ->orderby('residents.personReviewed','desc')
            ->offset(0)->limit(5)->get();

            return response()->json(['data'=>$top_rooms,'status'=>'success','statuscode'=>'200']);

        }catch(\Exception $e){
    
                return response()->json(['data'=>[],'status'=>'failed','statuscode'=>'500']);
            } 
        
    }


}
