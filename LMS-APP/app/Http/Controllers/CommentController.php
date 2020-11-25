<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');   
        $this->authorizeResource(Comment::class);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'course_material_id' => ['numeric'],
            'comment' => ['required']
        ]);
        $attributes['user_id'] = Auth::id();
        Comment::create($attributes);
        return redirect(route('course-materials.show', $attributes['course_material_id']))->with('success', 'Commented successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect(route('course-materials.show', $comment->course_material_id))->with('success', 'Comment deleted successfully');
    }
}
