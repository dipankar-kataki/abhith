<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReportPost;
use App\Models\KnowledgeForumPost;
use Illuminate\Support\Facades\Auth;

class ReportPostController extends Controller
{
    public function reportPost(Request $request){
        $postId = $request->postId;
        $getPost = ReportPost::where('knowledge_forum_post_id', $postId)->first();
        if($getPost == null){
            ReportPost::create([
                'knowledge_forum_post_id' => $postId,
                'report_count' => 1,
            ]);
        }else{
            ReportPost::where('knowledge_forum_post_id' ,$postId)->update([
                'report_count' => $getPost->report_count + 1,
            ]);
        }
        return response()->json(['success' => 'Post reported successfully.']);
        
    }

    public function getReportedPost(Request $request){
        $reportedPosts = ReportPost::all();
        return view('admin.report.reported-post')->with(['reportedPosts' => $reportedPosts]);
    }

    public function moveToTrash(Request $request){
        $postId = $request->post_id;
        $status = $request->active;
        KnowledgeForumPost::where('id',$postId)->update([
            'is_activate' =>  $status
        ]);
        ReportPost::where('knowledge_forum_post_id',$postId)->update([
            'is_activate' =>  $status
        ]);;
        return response()->json(['success' => 'Post status updated successfully']);
    }
}
