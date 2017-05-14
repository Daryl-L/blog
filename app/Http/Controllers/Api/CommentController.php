<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * @var App\Comment
     */
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->comment
            ->with('article')
            ->with('comment')
            ->with('comments')
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $article = \App\Article::findOrFail($request->input('article'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Article not found.',
            ], 404);
        }

        $parentComment = $this->comment->find($request->input('parent'));

        $article->comments()->save(new Comment([
            'content'    => $request->input('content');
            'comment_id' => $parentComment ? $parentComment->id : 0,
            'article_id' => $article->id,
            'user_id'    => 0, //from the authentation
        ]));

        return response()->json([
            'msg' => 'Comment created successfully.',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $comment = $this->comment
                ->with('article', 'comment', 'comments')
                ->findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Comment not found.',
            ], 404);
        }

        return $comment;
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
        try {
            $comment = $this->comment->findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Comment not found.',
            ], 404);
        }

        $comment->content = $request->input('content');
        $comment->save();

        return response()->json([
            'msg' => 'Comment updated successfully.',
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $comment = $this->comment->findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Comment not found.',
            ], 404);
        }

        $comment->comments()->delete();
        $comment->delete();

        return response()->json([], 204);
    }
}
