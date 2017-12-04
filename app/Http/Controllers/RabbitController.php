<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twitter;
use File;
use Abraham\TwitterOAuth\TwitterOAuth;

class RabbitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consumer_key = 	'0RI7kFzUuIQ0awFi2qk9d88VE';
        $consumer_secret = 'mJGJkjyNPS7aXkFzb5UYYd06FDLJtcGRCNLSzYZfd1zbOx6IbM';
        $access_token = '936623449325236224-YH3s1jMnPuVKeuGFYm0x5KPve7ySiGk';
        $access_token_secret = 'JSmjtGI4P8SA33dvVMRzwp4q1SzOzShaFNltmFfSmjTCH';
        
        $connection = new TwitterOAuth($consumer_key,$consumer_secret,$access_token,$access_token_secret);
        $content = $connection->get("account/verify_credentials");
        
        
        
        $statuses = $connection->get("statuses/home_timeline",["count" => 10000,"exclude_replies" => true]);

   
        
     return view('TwitterDetail')->with('statused', $statuses);  
       
       return round($this->distance(13.7224438,100.5362831,7.8611739,98.3700539, "K"),0) ;
       // return view('TwitterDetail');
    }
     
 function distance(Request $request) {

  $theta = $request->lon1 - $request->lon2;
  $dist = sin(deg2rad($request->lat1)) * sin(deg2rad($request->lat2)) +  cos(deg2rad($request->lat1))
          * cos(deg2rad($request->lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($request->unit);

  if ($unit == "K") {
    return round(($miles * 1.609344),0);
  } else if ($unit == "N") {
      return round(($miles * 0.8684),0);
    } else {
        return round($miles,0);
      }
}

    public function GoRabbitMap()
    {
       
        $consumer_key = 	'0RI7kFzUuIQ0awFi2qk9d88VE';
        $consumer_secret = 'mJGJkjyNPS7aXkFzb5UYYd06FDLJtcGRCNLSzYZfd1zbOx6IbM';
        $access_token = '936623449325236224-YH3s1jMnPuVKeuGFYm0x5KPve7ySiGk';
        $access_token_secret = 'JSmjtGI4P8SA33dvVMRzwp4q1SzOzShaFNltmFfSmjTCH';
        
        $connection = new TwitterOAuth($consumer_key,$consumer_secret,$access_token,$access_token_secret);
        $content = $connection->get("account/verify_credentials");
        
        
        
        $statuses = $connection->get("statuses/home_timeline",["count" => 10000,"exclude_replies" => true]);
          

                foreach ($statuses as $data)
             {              
                if (isset($data->text))
                {
                 $data->text = str_replace("\n", " ", $data->text);
                }
                
               if (isset($data->created_at))
                {
                 $data->created_at = $this->ToDateFormat($data->created_at);        
                }
             }
    
        
       return view('RabbitMap')->with('statused', $statuses);
    }
    
    public function ToDateFormat($date)
    {
        $newdate = "";
        $newdate = substr($date,-4) . "-";
        
        if (substr($date,4,3) == "Jan")
        {
            $newdate .= "01";
        }else if (substr($date,4,3) == "Feb")
        {
            $newdate .= "02";
        }
        else if (substr($date,4,3) == "Mar")
        {
            $newdate .= "03";
        }
        else if (substr($date,4,3) == "Apr")
        {
            $newdate .= "04";
        }
        else if (substr($date,4,3) == "May")
        {
            $newdate .= "05";
        }
        else if (substr($date,4,3) == "Jun")
        {
            $newdate .= "06";
        }
        else if (substr($date,4,3) == "Jul")
        {
            $newdate .= "07";
        }
        else if (substr($date,4,3) == "Aug")
        {
            $newdate .= "08";
        }
        else if (substr($date,4,3) == "Sep")
        {
            $newdate .= "09";
        }
        else if (substr($date,4,3) == "Oct")
        {
            $newdate .= "10";
        }
        else if (substr($date,4,3) == "Nov")
        {
            $newdate .= "11";
        }
        else if (substr($date,4,3) == "Dec")
        {
            $newdate .= "12";
        }
        
        
        $newdate .=  "-" . substr($date,8,2) . " " .  substr($date,10,9);
        return $newdate;
    }
    
        public function twitterUserTimeLine()
    {
    	$data = Twitter::getHomeTimeline(["count" => 10000,'format' => 'array']);
    	return  $data;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function tweet(Request $request)
    {
    	$this->validate($request, [
        		'tweet' => 'required'
        	]);

    	$newTwitte = ['status' => $request->tweet];

    	
    	if(!empty($request->images)){
    		foreach ($request->images as $key => $value) {
    			$uploaded_media = Twitter::uploadMedia(['media' => File::get($value->getRealPath())]);
    			if(!empty($uploaded_media)){
                    $newTwitte['media_ids'][$uploaded_media->media_id_string] = $uploaded_media->media_id_string;
                }
    		}
    	}

    	$twitter = Twitter::postTweet($newTwitte);

    	
    	return back();
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
