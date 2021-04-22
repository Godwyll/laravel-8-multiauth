<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facades;
use Illuminate\Support\Facades\DB;

class Helpers
{
    public function __construct(){

    }

    // Function to Get User's Full Name
    public static function getUserName($user_id){
        $user = App\User::where('id', $user_id)->first();
        $fullname = $user->firstname." ".$user->lastname;
        return $fullname;
    }

    public static function ago($time)
    {
        if (isset($time)) {
            $time = strtotime($time);

            $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
            $lengths = array("60","60","24","7","4.35","12","10");
         
            $now = time();
         
                $difference     = $now - $time;
                $tense         = "ago";
         
            for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
                $difference /= $lengths[$j];
            }
         
            $difference = round($difference);
         
            if($difference != 1) {
                $periods[$j].= "s";
            }
         
            return "$difference $periods[$j] ago ";
        } else {
            return NULL;
        }
        
    }    

    // TimeAgo Function
    public static function timeAgo($oldTime){
        if(isset($oldTime)){
        $newTime = date("Y-m-d H:i:s");
        $month = date(("F"), strtotime($oldTime));
        $month = substr($month,0,3);

        $timeCalc = strtotime($newTime) - strtotime($oldTime);
        if ($timeCalc >= (60*60*24*30*12*2)){
                $timeCalc = date(("j "), strtotime($oldTime)). $month ." ". date(("Y, g:i A"), strtotime($oldTime));
            }else if ($timeCalc >= (60*60*24*30*12)){
                $timeCalc = date(("j "), strtotime($oldTime)). $month ." ". date(("Y, g:i A"), strtotime($oldTime));
            }else if ($timeCalc >= (60*60*24*30*2)){
                $timeCalc = $month ." ". date(("j, g:i A"), strtotime($oldTime));
            }else if ($timeCalc >= (60*60*24*30)){
                $timeCalc = $month ." ". date(("j, g:i A"), strtotime($oldTime));
            }else if ($timeCalc >= (60*60*24*2)){
                $timeCalc = $month ." ". date(("j, g:i A"), strtotime($oldTime));
            }else if ($timeCalc >= (60*60*24)){
                $timeCalc = " Yesterday, ". date(("g:i A"), strtotime($oldTime));
            }else if ($timeCalc >= (60*60*2)){
                $timeCalc = $month." ". date(("j, g:i A"), strtotime($oldTime));
            }else if ($timeCalc >= (60*60)){
                $timeCalc = " Today, ". date(("g:i A"), strtotime($oldTime));
            }else if ($timeCalc >= 60*2){
                $timeCalc = intval($timeCalc/60) . " minutes ago";
            }else if ($timeCalc >= 60){
                $timeCalc = intval($timeCalc/60) . " minute ago";
            }else if ($timeCalc > 0){
                $timeCalc .= " seconds ago";
            }else if ($timeCalc == 0){
                $timeCalc = " now";
            }
        return $timeCalc;
        }else{
            return $timeCalc=NULL;
        }
    }

    // Cool Date Function 
    public static function coolDate($date){
        if(isset($date)){
            $coolDate = date("D, jS M Y", strtotime($date));
            return $coolDate;
        }else{
            return $coolDate=NULL;
        }
    }

    // Time Meridian
    public static function coolTime($time){
        return date(("g:i a"), strtotime($time));
    }

    // Cool DateTime Function 
    public static function coolDateTime($date){
        if(isset($date)){
        $coolDate = date("D, jS M Y g:i a", strtotime($date));
        return $coolDate;
        }else{
            return $coolDate=NULL;
        }
    }

    // Return if a Student Attendance entry exist for a Session
    public static function entryExist($student_no, $session_id){
        if(\App\Models\Entry::where('student_no', $student_no)->where('session_id', $session_id)->first()){
            return true;
        }
    }

    // Function to return if a student is Freshman
    public static function isStudent($student_no){
        if(\App\Models\Student::where('student_no', $student_no)->first()){
            return true;
        }        
    }    

    // Function to return the session number of a Timetable Entry
    public static function getSession($timetable_id){
        if($timetable = \App\Models\Timetable::find($timetable_id)){
            switch ($timetable->start_time) {
                case '08:30:00':
                    $session = "1";
                    break;
                
                case '12:15:00':
                    $session = "2";
                    break;
                
                case '16:00:00':
                    $session = "3";
                    break;
                
                default:
                    $session = NULL;
                    break;
            }
            
            return $session;
        }        
    }    

    // Function to Truncate Text
    public static function truncate($text, $length){
        if(strlen($text)>$length){
            $truncate = substr($text, 0, $length)."...";
            return $truncate;
        }else{
            return $text;
        }
    }

    // Function to Calculate Date from a Given Number of Day(s)
    // public static function dateFromDays($days){
    //     $dateCalc = strtotime(date('Y-m-d ').'00:00:00 - '.$days.' day');
    //     $dateResult = date('Y-m-d H:i:s', $dateCalc);
    //     return $dateResult;
    // }

    // Function to Calculate Date from a Given Number of Day(s)
    public static function dateFromDays($days){
        $dateCalc = strtotime(date('Y-m-d ').'00:00:00 - '.$days.' day');
        $dateResult = date('Y-m-d H:i:s', $dateCalc);
        return $dateResult;
    }


}
