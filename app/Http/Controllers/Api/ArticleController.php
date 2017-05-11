<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * @var App\Article
     */
    protected $article;

    public function __construct(\App\Article $article)
    {
        $this->article = $article;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->article->withCount('comments')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = $this->article->where('sign', $request->input('sing'))->firstOrNew();

        if (!$article->id) {
            $article->title       = $request->input('title');
            $article->content     = $request->input('content');
            $article->description = $request->input('description');
            $article->cateogry_id = $request->input('category');
            $article->save();

            return response()->json([
                'msg' => 'Article created successfully'.
            ], 201);
        } else {
            return response()->json([
                'error' => 'Article already exists.',
            ], 409);
        }
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
            $article = $this->article->with('comments', function ($query) {
                $query->where('comment_id', 0);
                $query->with('comments');
            })
            ->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Article not found.'
            ], 404);
        }

        return $article;
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
            $article = $this->article->findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Article not found.',
            ], 404);
        }

        $article->title       = $request->input('title');
        $article->content     = $request->input('content');
        $article->description = $request->input('description');
        $article->cateogry_id = $request->input('category');
        $article->save();

        return response()->json([
            'msg' => 'Article updated successfully.',
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
            $article = $this->article->findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Article not found.',
            ], 404);
        }

        $article->delete();
        
        return response()->json([], 204);
    }
}
