<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Order;
use App\Common\Activation;
use App\Models\TimeTable;

use Illuminate\Support\Facades\Auth;

class TimeTableController extends Controller
{

    public function websiteViewTimeTable(Request $request){
        $data = [];
        if(Auth::check()){
            $details = Order::where('user_id', Auth::user()->id)->get();
            foreach($details as $item){
            
                $time_data = TimeTable::with('course', 'chapter')->where('course_id', $item->course_id)->where('chapter_id', $item->chapter_id)->where('is_activate', 1)->get();
                array_push($data, $time_data);
            }
        }
        
        
        return view('website.time-table.time-table')->with(['data' =>  $data]);
    }

    public function timeTable(Request $request){

        $courses = Course::where('is_activate', Activation::Activate)->orderBy('id', 'DESC')->get();
        $chapters = [];
        if($request->ajax()){
                $chapters = Chapter::where('course_id', $request->course_id)->get();
            return response()->json(['chapter' => $chapters]);
        }
        
        return view('admin.time-table.add-time-table')->with(['chapter' => $chapters, 'course' => $courses]);
    }

    public function addTimeTable(Request $request){
        $chapter = $request->chapter;
        $course = $request->course;
        $zoom_link = $request->zoom_link;
        $add_time = $request->add_time;
        $add_date = $request->add_date;


        $request->validate([
            'chapter' => 'required',
            'course' => 'required',
            'zoom_link' => 'required',
            'add_time' => 'required',
            'add_date' => 'required',
        ]);

        

        $create = TimeTable::create([
            'chapter_id' => $chapter,
            'course_id' => $course,
            'time' => $add_time,
            'date' => $add_date,
            'zoom_link' => $zoom_link,
            'is_activate' => Activation::Activate,

        ]);

        if($create){
            return response()->json(['message' => 'Time Table created successfully']);
        }else{
            return response()->json(['message' => 'Oops! Something went wrong']);
        }
    }
}
