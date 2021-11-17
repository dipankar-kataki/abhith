<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Common\Activation;
use App\Models\Subject;
use App\Models\Chapter;
use Carbon\Carbon;

class CourseController extends Controller
{
    public function index()
    {
        # code...
        // $courses = Course::where('is_activate',Activation::Activate)->paginate(10);
        $publishCourse = [];
        $upComingCourse = [];
        $price = [];

        $courses = Course::where('is_activate', Activation::Activate)->with('priceList')->orderBy('id', 'DESC')->get();

        foreach ($courses as $key => $value) {
            # code...
            $price = [];
            $publishDate = Carbon::parse($value->publish_date)->format('Y-m-d') ;
            $Today = Carbon::today()->format('Y-m-d');
            if ($publishDate < $Today) {
                //  dd('less today', $value->publish_date);
                $chapters = Chapter::where([['course_id', $value->id],['is_activate',Activation::Activate]])->get();
                foreach ($chapters as $key => $value2) {
                    # code...
                    $price [] = $value2->price;
                }
                $final_price = array_sum($price);
                $published['final_price']=$final_price;
                $published['id']=$value->id;
                $published['name']=$value->name;
                $published['course_pic']=$value->course_pic;
                $published['duration']=$value->durations;
                $published['publish_date']=$value->publish_date;
                $publishCourse[] = $published;
            } elseif ($publishDate == $Today) {
                //    dd('Not Today', $value->publish_date);
                $publishTime = Carbon::parse($value->publish_date)->format('H:i');
                $presentTime = Carbon::now()->format('H:i');
                if ($publishTime < $presentTime) {
                $chapters = Chapter::where([['course_id', $value->id],['is_activate',Activation::Activate]])->get();
                    foreach ($chapters as $key => $value3) {
                        # code...
                        $price [] = $value3->price;
                    }
                    $final_price = array_sum($price);
                    $published['final_price']=$final_price;
                    $published['id']=$value->id;
                    $published['name']=$value->name;
                    $published['course_pic']=$value->course_pic;
                    $published['duration']=$value->durations;
                    $published['publish_date']=$value->publish_date;
                    $publishCourse[] = $published;
                } else {
                    $upcoming['id']=$value->id;
                    $upcoming['name']=$value->name;
                    $upcoming['course_pic']=$value->course_pic;
                $upcoming['duration']=$value->durations;
                    $upcoming['publish_date']=$value->publish_date;
                    $upComingCourse[] = $upcoming;
                }
            } elseif ($publishDate > $Today) {
                // dd('GRATER Today', $value->publish_date);
                $upcoming['id']=$value->id;
                $upcoming['name']=$value->name;
                $upcoming['duration']=$value->durations;
                $upcoming['course_pic']=$value->course_pic;
                $upcoming['publish_date']=$value->publish_date;
                $upComingCourse[] = $upcoming;
            }
        }
        $subjects = Subject::where('is_activate',Activation::Activate)->get();

        $response = [
            'subjects' => $subjects, 
            'publishCourse' => $publishCourse,
            'upcomingCourse' => $upComingCourse
        ];
        // dd($publishCourse);
        return response()->json(['response' => $response, 'message' => 'Data fetch successfully']);
    }
}
