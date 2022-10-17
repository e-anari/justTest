<?php

namespace App\Http\Controllers\Admin\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::query();

        if (request('search')) {
            $keyword = trim(request('search'));
            $comments->where('comment', 'LIKE', "%{$keyword}%")->orWhereHas('user', function ($query) use ($keyword){
                $query->where('username', 'like', "%{$keyword}%");
            });
        }

        if (request('sorting')) {
            $sort = request('sorting');
            switch ($sort) {
                case 'desc':
                    $comments->orderby('created_at', 'desc');
                    break;
                case 'asc':
                    $comments->orderby('created_at', 'asc');
                    break;

                default:
                    # code...
                    break;
            }
        }

        $comments = $comments->latest()->paginate(10);
        return view('admin.comment.index', compact('comments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        auth()->user()->comments()->create([
            'comment' => $request->get('comment'),
            'commentable_id' => $request->get('commentable_id'),
            'commentable_type' => $request->get('commentable_type'),
            'parent_id' => $request->get('parent_id'),
        ]);

        \session('success', 'Your comment added.');
        return redirect()->route('detail', $request->get('commentable_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment, Request $request)
    {
        if ($request->ajax()) {
            return view('admin.comment.show', compact($comment));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('comment.edit', compact($comment));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $data = $request->validate([
            'comment' => ['required'],
        ]);

        $comment->update($data);
        return redirect()->route('comment.index');
    }

    public function approve(Comment $comment)
    {
        if ($comment->approved) {
            $comment->update(['approved' => 0]);
        } else {
            $comment->update(['approved' => 1]);
        }

        return redirect()->route('comment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back();
    }
}
