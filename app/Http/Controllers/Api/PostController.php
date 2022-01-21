<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort_field = $request->sort_field;
        if (!in_array($sort_field, ['title', 'text', 'created_at'])) {
            $sort_field = 'created_at';
        }

        $sort_direction = $request->sort_direction;
        if (!in_array($sort_direction, ['desc', 'asc'])) {
            $sort_direction = 'desc';
        }

        $posts = Post::when($request->category_id && $request->category_id != '',
            function ($q) use ($request) {
                return $q->where('category_id', $request->category_id);
            })->orderBy($sort_field, $sort_direction)
            ->paginate(10);

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
